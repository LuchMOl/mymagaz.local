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

    public function checkUser($email)
    {
        $userDao = new UserDao();
        $data = $userDao->checkUser($email);

        if (empty($data)) {
            return $userExist = FALSE;
        } else {
            return $data;
        }
    }

    public function setUser($email, $name, $password)
    {
        $userDao = new UserDao();
        $userDao->setUser($email, $name, $password);
    }

    public function setGreetingUser($param)
    {
        setcookie('name', $param, time() + 30, '/');
        $_SESSION['time'] = date("Y-m-d H:i:s");
    }

    static function getGreetingUser()
    {
        if (isset($_COOKIE['name']) && isset($_SESSION['time'])) {
            echo 'Ну здравствуй, ' . $_COOKIE['name'] . '. ';
            echo '<br> Дата входа: ' . $_SESSION['time'];
        } else {
            echo 'Не регнут.';
        }
    }

}
