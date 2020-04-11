<?php

class UserController
{

    function __construct()
    {
        echo "
            <section id='newsletter'  class='newsletter'>
                <div class='container'>
					<div class='hm-foot-menu'>
                    <ul>
             ";
    }

    public function actionIndex()
    {
        echo "
            <li><a href = '/user/signin/'>SignIn</a></li>
            <li><a href = '/user/register/'>Register</a></li>

             ";
    }

    public function actionSignIn()
    {
        echo file_get_contents("../views/user/signin.php");

        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $userService = new UserService();
            $userExist = $userService->getUser($_POST["email"], $_POST["password"]);

            if ($userExist === FALSE) {
                echo 'Нет такого!';
            } else {
                var_dump($userExist);
            }
            //die;
        } else {
            echo "Введены не полные данные.";
        }
    }

    public function actionRegister()
    {
        echo file_get_contents("../views/user/register.php");

        if (!empty($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["password"])) {
            $userService = new UserService();
            $userExist = $userService->getUser($_POST["email"], $_POST["name"]);
            if ($userExist === FALSE) {
                $userService->setUser($_POST["email"], $_POST["name"], $_POST["password"]);
            } else {
                echo "Пользователь с таким email/name уже существует";
            }
        }
    }

    function __destruct()
    {
        echo "</ul>
                </div>
                    </div>
                </section>
            ";
    }

}
