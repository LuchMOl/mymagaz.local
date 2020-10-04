<?php

namespace app\services;

use app\dao\mapper\UserMapper;
use app\dao\UserDao;
use app\dao\CartDao;
use app\services\ProductService;

class UserService
{

    private $userDao;
    private $cartDao;
    private $userMapper;
    private $productService;

    public function userDao()
    {
        if ($this->userDao === NULL) {
            $this->userDao = new UserDao();
        }
        return $this->userDao;
    }

    public function cartDao()
    {
        if ($this->cartDao === NULL) {
            $this->cartDao = new CartDao();
        }
        return $this->cartDao;
    }

    public function userMapper()
    {
        if ($this->userMapper === NULL) {
            $this->userMapper = new UserMapper();
        }
        return $this->userMapper;
    }

    public function productService()
    {
        if ($this->productService === NULL) {
            $this->productService = new ProductService();
        }
        return $this->productService;
    }

    public function getUser($email, $password)
    {
        $userIsset = $this->userDao()->getUser($email, $password);
        if (is_array($userIsset)) {
            $user = $this->userMapper()->map($userIsset);
        } else {
            $user = false;
        }
        return $user;
    }

    public function getUserBySesId($sessionId)
    {
        $user = $this->userDao()->getUserBySesId($sessionId);
        $user = $this->userMapper()->map($user);
        $this->saveUserInSession($user);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $data = $this->userDao()->getUserByEmail($email);
        if (!empty($data)) {
            $result = $data;
        } else {
            $result = false;
        }
        return $result;
    }

    public function registerUser($user)
    {
        return $this->userDao()->insertUser($user);
    }

    public function saveUserInSession($user)
    {
        setcookie('sessId', $user->sessionId, 0x7FFFFFFF, '/');
        $user = base64_encode(serialize($user));
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser()
    {
        if (isset($_SESSION['user'])) {
            $currentUser = unserialize(base64_decode($_SESSION['user']));
        } elseif (isset($_COOKIE['sessId'])) {
            $currentUser = $this->getUserBySesId($_COOKIE['sessId']);
        } else {
            $currentUser = $this->userMapper()->map('');
            $this->saveUserInSession($currentUser);
        }
        return $currentUser;
    }

}
