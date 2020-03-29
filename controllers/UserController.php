<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br>';

        require '../views/user/index.php';
    }

    function actionSignIn()
    {
        echo __METHOD__ . '<br>';

        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $userService = new UserService();
            $userExist = $userService->getUser($_POST["email"], $_POST["password"]);

            if ($userExist === FALSE) {
                echo 'Нет такого!';
            }
            die;
        } else {
            echo "Введены не полные данные.";
        }
    }

    function actionCreate()
    {
        echo __METHOD__ . '<br>';
    }

}
