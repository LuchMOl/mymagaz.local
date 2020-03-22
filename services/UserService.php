<?php

class UserService
{

    public function getUsers()
    {
        $userDao = new UserDao();
        $data = $userDao->getUsers();
        var_dump($data);
        $userMapper = new UserMapper();
        $userMapper->map($data);
    }

}
