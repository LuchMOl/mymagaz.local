<?php

class UserController
{

    public function actionIndex()
    {
        require_once '/../views/layouts/header.php';
        echo "
            <div class='container'>
            <li><a href = '/user/signin/'>SignIn</a></li>
            <li><a href = '/user/register/'>Register</a></li>
             ";
        require_once '/../views/layouts/footer.php';
    }

    public function actionSignIn()
    {
        require_once '/../views/layouts/header.php';
        echo file_get_contents("../views/user/signin.php");

        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"] && $_POST["password"])) {
                if (preg_match('/@/', $_POST["email"])) {
                    $userService = new UserService();
                    $userExist = $userService->getUser($_POST["email"], $_POST["password"]);

                    if ($userExist === FALSE) {
                        echo 'Нет такого!';
                    } else {
                        var_dump($userExist);
                    }
                } else {
                    echo $_POST["email"] . ' не Email.';
                }
            } else {
                echo "Введены не полные данные.";
            }
        }
        require_once '/../views/layouts/footer.php';
    }

    public function actionRegister()
    {
        require_once '/../views/layouts/header.php';
        echo file_get_contents("../views/user/register.php");

        if (isset($_POST['submit'])) {
            if (!empty($_POST["email"] && $_POST["name"] && $_POST["password"])) {
                if (preg_match('/@/', $_POST["email"])) {
                    $userService = new UserService();
                    $userExist = $userService->checkUser($_POST["email"], $_POST["name"]);
                    if ($userExist === FALSE) {
                        $userService->setUser($_POST["email"], $_POST["name"], $_POST["password"]);

                        echo '<script>location.href= "/";</script>';
                    } else {
                        echo "Пользователь с таким email/name уже существует.";
                    }
                } else {
                    echo $_POST["email"] . ' не Email.';
                }
            } else {
                echo "Введены не полные данные для регистрации.";
            }
        }
        require_once '/../views/layouts/footer.php';
    }

}
