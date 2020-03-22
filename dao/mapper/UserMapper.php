<?php

class UserMapper
{

    public function map($data)
    {
        $user = new User;
        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        var_dump($user);
    }

}
