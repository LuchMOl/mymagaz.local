<?php

namespace app\models;

class User
{

    public $id;
    public $email;
    public $password;
    public $name;
    public $sessionId;
    public $orderCart;
    public $order;

    public function setId($user)
    {
        if (isset($user['id'])) {
            $this->id = $user['id'];
        } else {
            $this->id = '0';
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

    public function setOrder($user)
    {
        if (isset($user['order'])) {
            $this->order [] = $user['order'];
        } else {
            $this->order = [];
        }
    }

    public function addEmail($email)
    {
        $this->email = $email;
    }

    public function addName($name)
    {
        $this->name = $name;
    }

    public function addPassword($password)
    {
        $this->password = $password;
    }

    public function addOrder($product)
    {
        $this->order [] = $product;
    }

    public function addOrders($products)
    {
        if (!empty($products)) {
            foreach ($products as $product) {
                $this->order [] = $product;
            }
        }
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
        return ($this->id == '0' && $this->name == 'Guest') ? true : false;
    }

    public function deleteOrderItem($orderItemId)
    {
        unset($this->order[$orderItemId]);
        array_values($this->order);
    }

    public function RegPrepare($post)
    {
        $this->email = $post["email"];
        $this->name = $post["name"];
        $this->password = $post["password"];
        session_regenerate_id();
        $this->sessionId = session_id();
    }

}
