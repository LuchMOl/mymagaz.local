<?php

class UserService
{

    private static $userDao = [];

    private static function userDao()
    {
        if (self::$userDao == NULL) {
            $userDao = new UserDao();
        } else {
            $userDao = self::$userDao;
        }
        return $userDao;
    }

    public function getUser($email, $password)
    {
        $user = self::userDao()->getUser($email, $password);
        if (is_array($user)) {
            $userMapper = new UserMapper();
            $userExist = $userMapper->map($user);
        } else {
            $userExist = false;
        }
        return $userExist;
    }

    static function getSIdUser($sessionId)
    {
        $userExist = self::userDao()->getSIdUser($sessionId);
        if (is_array($userExist)) {
            $userExist = $userMapper->map($userExist);
            self::saveUserInSession($userExist);
        } else {
            $userExist = self::GetUserGuest();
        }
        return $userExist;
    }

    public function checkUser($email)
    {
        $data = $this->userDao()->checkUser($email);
        if (is_numeric($data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function setUser($email, $name, $password)
    {
        return $this->userDao()->setUser($email, $name, $password);
    }

    static function getGreetingUser()
    {
        $user = self::getCurrentUser();
        if (is_numeric($user->id)) {
            $greeting = 'Ну здравствуй, ' . $user->name . '. ';
        } else {
            $greeting = "<a href = '/user/register/'>Зарегистрируйтесь</a> или <a href = '/user/signin/'>Авторизуйтесь</a>";
        }
        return $greeting;
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
            $currentUser = unserialize(base64_decode($_SESSION['user']));
        } elseif (isset($_COOKIE['sid'])) {
            $currentUser = self::getSIdUser($_COOKIE['sid']);
        } else {
            $currentUser = self::GetUserGuest();
        }
        return $currentUser;
    }

    static function GetUserGuest()
    {
        $userMapper = new UserMapper();
        $guest = ['id' => 'id', 'email' => '', 'password' => '', 'name' => 'Гость', 'session_id' => ''];
        return $userMapper->map($guest);
    }

}
