<?php

class UserController
{

    private $userExist;

    public function actionIndex()
    {
        require_once '../views/user/index.php';
    }

    public function actionSignIn()
    {
        $message = '';
        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"])) {
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["password"])) {

                        $userService = new UserService();
                        $userExist = $userService->getUser($_POST["email"], $_POST["password"]);

                        if ($userExist === FALSE) {
                            $message = 'Нет такого!';
                        } else {
                            $userService->setGreetingUser($userExist->name);
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
        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"])) {
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["name"])) {
                        if (!empty($_POST["password"])) {
                            $userService = new UserService();
                            $userExist = $userService->checkUser($_POST["email"]);
                            if ($userExist === FALSE) {
                                $userService->setUser($_POST["email"], $_POST["name"], $_POST["password"]);
                                $userService->setGreetingUser($_POST["name"]);
                                header('Location: http://mymagaz.local/');
                            } else {
                                $message = 'Пользователь с email - ' . $_POST["email"] . ' - уже существует под id - ' . $userExist . '.';
                            }
                        } else {
                            $message = 'Не введен пароль.';
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
        require_once '/../views/user/register.php';
    }

}
