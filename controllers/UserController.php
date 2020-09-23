<?php

namespace app\controllers;

use app\services\UserService;
use app\dao\mapper\UserMapper;

class UserController
{

    private $userExist;
    private $userService;
    private $userMapper;

    public function userService()
    {
        if ($this->userService === NULL) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }

    public function userMapper()
    {
        if ($this->userMapper === NULL) {
            $this->userMapper = new UserMapper();
        }
        return $this->userMapper;
    }

    public function actionIndex()
    {
        require_once '../views/user/index.php';
    }

    public function actionSignIn()
    {
        $message = '';
        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"])) {
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-\'.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["password"])) {
                        $userExist = $this->userService()->getUser($_POST["email"], $_POST["password"]);
                        if (!$userExist) {
                            $message = 'Нет такого!';
                        } else {
                            $this->userService()->saveUserInSession($userExist);
                            header('Location: http://mymagaz.local/');
                        }
                    } else {
                        $message = 'Не введен пароль.';
                    }
                } else {
                    $message = $_POST["email"] . ' не Email.';
                }
            } else {
                $message = 'Не введен email.';
            }
        }
        require_once '../views/user/signin.php';
    }

    public function actionRegister()
    {
        $message = '';
        $user = $this->userService()->getCurrentUser();
        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"])) {
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-\'.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["name"])) {
                        if (preg_match("/[a-zA-Z0-9\.\_-]/", $_POST["name"])) {
                            if (!empty($_POST["password"])) {
                                if (preg_match("/[a-zA-Z0-9]/", $_POST["password"])) {
                                    $userExist = $this->userService()->getUserByEmail($_POST["email"]);
                                    if (!$userExist) {
                                        $user->RegPrepare($_POST);
                                        $write = $this->userService()->registerUser($user);
                                        if ($write) {
                                            $this->userService()->saveUserInSession($user);
                                            header('Location: http://mymagaz.local/');
                                        } else {
                                            $message = 'Не удачная попытка регистрации.';
                                        }
                                    } else {
                                        $message = 'Вы уже зарегистрированы';
                                    }
                                } else {
                                    $message = 'Пароль может содержать только цифры, заглавные и строчные буквы.';
                                }
                            } else {
                                $message = 'Не введен пароль.';
                            }
                        } else {
                            $message = $_POST["name"] . ' - Имя может содержать только цифры, заглавные и строчные буквы.';
                        }
                    } else {
                        $message = 'Не введено имя.';
                    }
                } else {
                    $message = $_POST["email"] . ' не Email.';
                }
            } else {
                $message = 'Не введен email.';
            }
        }
        require_once '../views/user/register.php';
    }

    public function actionExit()
    {
        session_destroy();
        setcookie('sessId', '', 1, '/');
        sleep(2);
        header('Location: http://mymagaz.local/');
    }

}
