<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        StaticService::renderLinks();

        $userService = new UserService();
        $userService->getUsers('admin');
        $userService->getUsers('user');
        $userService->getUsers('admin');
        $userService->getUsers('guest');

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
