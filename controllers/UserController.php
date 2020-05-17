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
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-\'.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["password"])) {
                        $userService = new UserService();
                        $userExist = $userService->getUser($_POST["email"], $_POST["password"]);
                        if (!$userExist) {
                            $message = 'Нет такого!';
                        } else {
                            $userService->saveUserInSession($userExist);
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
                if (preg_match("/^[a-zA-Zа-яА-Я0-9_\-\'.]+@[a-zA-Zа-яА-Я0-9\-]+\.[a-zA-Zа-яА-Я0-9\-.]+$/", $_POST["email"])) {
                    if (!empty($_POST["name"])) {
                        if (preg_match("/[a-zA-Z0-9\.\_-]/", $_POST["name"])) {
                            if (!empty($_POST["password"])) {
                                if (preg_match("/[a-zA-Z0-9]/", $_POST["password"])) {
                                    $userService = new UserService();
                                    $userExist = $userService->checkUser($_POST["email"]);
                                    if (!$userExist) {
                                        $writeId = $userService->setUser($_POST["email"], $_POST["name"], $_POST["password"]);
                                        if (is_numeric($writeId)) {
                                            $userMapper = new UserMapper();
                                            $data = ['id' => $writeId, 'email' => $_POST["email"], 'password' => $_POST["password"], 'name' => $_POST["name"], 'session_id' => session_id()];
                                            $userExist = $userMapper->map($data);
                                            $userService->saveUserInSession($userExist);
                                            header('Location: http://mymagaz.local/');
                                        } else {
                                            $message = 'Не удачная попытка регистрации.';
                                        }
                                    } else {
                                        $message = 'Пользователь с email - ' . $_POST["email"] . ' - уже существует';
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
        require_once '/../views/user/register.php';
    }

    public function actionExit()
    {
        session_destroy();
        setcookie('sid', '', 1, '/');
        sleep(2);
        header('Location: http://mymagaz.local/');
    }

}
