<?php

class UserService
{

    public function getUsers($userName)
    {
        $userDao = new UserDao();
        $data = $userDao->getUsers();
        //var_dump($data);
        $userMapper = new UserMapper();

        foreach ($data as $row) {

            if ($row['name'] == $userName) {
                $userMapper->map($row);
            }
        }
    }

}
