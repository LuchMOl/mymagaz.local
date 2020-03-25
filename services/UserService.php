<?php

class UserService
{

    public function getUsers($email, $password)
    {

        $userDao = new UserDao();
        $data = $userDao->getUsers($email, $password);
        //var_dump($data);
        //echo $data['password'];
        if (!is_null($data)) {
            $userMapper = new UserMapper();
            $userMapper->map($data);
        } else {
            echo 'Нет такого!';
        }
    }

}
