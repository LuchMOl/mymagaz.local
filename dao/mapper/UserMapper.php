<?php

class UserMapper
{

    public function map($data)
    {
        echo __METHOD__ . '<br>';
        $user = new User;

        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);

        var_dump($user);
    }

}

?>