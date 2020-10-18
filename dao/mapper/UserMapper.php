<?php

namespace app\dao\mapper;

use app\models\user;

class UserMapper
{

    public function map($data)
    {
        $user = new User();

        $user->setId($data);
        $user->setEmail($data);
        $user->setName($data);
        $user->setPassword($data);
        $user->setSessionId($data);
        $user->setCurrency($data);

        return $user;
    }

}
