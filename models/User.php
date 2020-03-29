<?php

class User
{

    public $id;
    public $email;
    public $password;
    public $name;

    public function setId($id)
    {
        echo __METHOD__ . '<br>';
        $this->id = $id;
    }

    public function setEmail($email)
    {
        echo __METHOD__ . '<br>';
        $this->email = $email;
    }

    public function setPassword($password)
    {
        echo __METHOD__ . '<br>';
        $this->password = $password;
    }

    public function setName($name)
    {
        echo __METHOD__ . '<br>';
        $this->name = $name;
    }

}
?>
