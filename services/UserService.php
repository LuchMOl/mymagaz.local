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
            return false;
        }
    }

    static function getSIdUser($sessionId)
    {
        $userDao = new UserDao();
        $data = $userDao->getSIdUser($sessionId);
        if (is_array($data)) {
            $userMapper = new UserMapper();
            $userExist = $userMapper->map($data);
            self::saveUserInSession($userExist);
            return $userExist;
        } else {
            return false;
        }
    }

    public function checkUser($email)
    {
        $userDao = new UserDao();
        $data = $userDao->checkUser($email);

        if (is_numeric($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function setUser($email, $name, $password)
    {
        $userDao = new UserDao();
        return $userDao->setUser($email, $name, $password);
    }

    static function getGreetingUser()
    {
        $user = self::getCurrentUser();
        if (is_numeric($user->id)) {
            return 'Ну здравствуй, ' . $user->name . '. ';
        } elseif ($user->id == 'id') {
            return "<a href = '/user/register/'>Зарегистрируйтесь</a> или <a href = '/user/signin/'>Авторизуйтесь</a>";
        }
    }

    static function saveUserInSession($user)
    {
        setcookie('sid', $user->session_id, 0x7FFFFFFF, '/');
        $user = base64_encode(serialize($user));
        $_SESSION['user'] = $user;
    }

    static function getCurrentUser()
    {
        if (isset($_SESSION['user'])) {
            return unserialize(base64_decode($_SESSION['user']));
        } elseif (isset($_COOKIE['sid'])) {
            return self::getSIdUser($_COOKIE['sid']);
        } else {
            $userMapper = new UserMapper();
            $guest = ['id' => 'id', 'email' => '', 'password' => '', 'name' => 'Гость', 'session_id' => ''];
            return $userMapper->map($guest);
        }
    }

}
