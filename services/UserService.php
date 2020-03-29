<?php

class UserService
{

    public function getUser($email, $password)
    {
        echo __METHOD__ . '<br>';
        $userDao = new UserDao();
        $data = $userDao->getUser($email, $password);
        //var_dump($data);
        if (is_array($data)) {
            $userMapper = new UserMapper();
            $userMapper->map($data);
        } else {
            return $userExist = FALSE;
        }
    }

}
