<?php

namespace app\dao\mapper;

use app\models\user;

class UserMapper
{

    public function map($data)
    {
        $user = new User();

        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setSessionId($data['session_id']);

        return $user;
    }

}
