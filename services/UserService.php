<?php

class UserService
{

    public function getUser($email, $password)
    {
        $userDao = new UserDao();
        $data = $userDao->getUser($email, $password);

        if (is_array($data)) {
            $userMapper = new UserMapper();
            $userExist = $userMapper->map($data);
            return $userExist;
        } else {
            return $userExist = FALSE;
        }
    }

    public function checkUser($email, $name)
    {
        $userDao = new UserDao();
        $data = $userDao->checkUser($email, $name);
        if (is_array($data)) {
            return $userExist = TRUE;
        } else {
            return $userExist = FALSE;
        }
    }

    public function setUser($email, $name, $password)
    {
        $userDao = new UserDao();
        $userDao->setUser($email, $name, $password);
    }

}
