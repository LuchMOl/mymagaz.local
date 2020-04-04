<?php

class UserController
{

    function actionIndex()
    {
        require '../views/user/index.php';
    }

    function actionSignIn()
    {
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $userService = new UserService();
            $userExist = $userService->getUser($_POST["email"], $_POST["password"]);

            if ($userExist === FALSE) {
                echo 'Нет такого!';
            } else {
                var_dump($userExist);
            }
            die;
        } else {
            echo "Введены не полные данные.";
        }
    }

    function actionCreate()
    {

    }

}
