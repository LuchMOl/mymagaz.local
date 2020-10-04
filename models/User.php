<?php

namespace app\models;

use app\services\CartService;

class User
{

    public $id;
    private $guestSessId;
    public $email;
    public $password;
    public $name;
    public $sessionId;
    public $orderCart;
    public $cart;

    public function getGuestSessId()
    {
        return $this->sessionId;
    }

    public function setGuestSessId($guestSessId)
    {
        $this->guestSessId = $guestSessId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($user)
    {
        if (isset($user['id'])) {
            $this->id = $user['id'];
        } else {
            $this->id = '';
        }
    }

    public function setEmail($user)
    {
        if (isset($user['email'])) {
            $this->email = $user['email'];
        } else {
            $this->email = '';
        }
    }

    public function setName($user)
    {
        if (isset($user['name'])) {
            $this->name = $user['name'];
        } else {
            $this->name = 'Guest';
        }
    }

    public function setPassword($user)
    {
        if (isset($user['password'])) {
            $this->password = $user['password'];
        } else {
            $this->password = '';
        }
    }

    public function setSessionId($user)
    {
        if (isset($user['sessionId'])) {
            $this->sessionId = $user['sessionId'];
        } elseif (isset($_COOKIE['sessId'])) {
            $this->sessionId = $_COOKIE['sessId'];
        } else {
            $this->sessionId = session_id();
        }
    }

    public function getCart()
    {
        if (!$this->cart) {
            $this->cart = (new CartService())->getCart($this);
        }
        return $this->cart;
    }

    public function getGreeting()
    {
        if (!$this->isGuest()) {
            $greeting = 'Ну здравствуй, ' . $this->name . '. ';
        } else {
            $greeting = "Вы вошли как Гость. <a href = '/user/signin/'>Авторизуйтесь</a> или <a href = '/user/register/'>Зарегистрируйтесь</a>";
        }
        return $greeting;
    }

    public function isGuest()
    {
        return ($this->id == '' && $this->name == 'Guest') ? true : false;
    }

    public function RegPrepare($post)
    {
        $this->email = $post["email"];
        $this->name = $post["name"];
        $this->password = $post["password"];
        $this->isGuest() ? '' : session_regenerate_id();
        $this->sessionId = session_id();
    }

}
