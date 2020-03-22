<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        StaticService::renderLinks();

        $userService = new UserService();
        $users = $userService->getUsers();

        die;
    }

    function actionLogin()
    {
        echo __METHOD__ . '<br><br>';
    }

    function actionCreate()
    {
        echo __METHOD__ . '<br><br>';
    }

}
