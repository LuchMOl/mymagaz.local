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

}
