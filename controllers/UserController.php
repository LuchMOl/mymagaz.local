<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        //StaticService::renderLinks();

        echo "<form method = 'post' action = 'http://mymagaz.local/user/signin/'>Sign In:<br><br>
        Логин:  <input name = 'email'    type = 'text' maxlength = '30' size = '30' value = 'email'    /><br><br>
        Пароль: <input name = 'password' type = 'text' maxlength = '20' size = '30' value = 'password' /><br><br>
        <input type = submit value = 'Sign In'></form>";
    }

    function actionSignIn()
    {
        echo __METHOD__ . '<br><br>';

        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $userService = new UserService();
            $userService->getUsers($_POST["email"], $_POST["password"]);
            die;
        } else {
            echo "Введены не полные данные.";
        }
    }

    function actionCreate()
    {
        echo __METHOD__ . '<br><br>';
    }

}
