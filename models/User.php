<?php

namespace app\models;

class User
{

    public $id;
    public $email;
    public $password;
    public $name;
    public $session_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
    }

    public function getId()
    {
        return userService::getCurrentUser()->id;
    }

    public function getName()
    {
        return userService::getCurrentUser()->name;
    }

}
