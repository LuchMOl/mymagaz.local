<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        StaticService::renderLinks();
        $userDao = new UserDao();
        $result = $userDao->getUsers();
        var_dump($result);
        /*
        echo '<br>id => ' . $result['id'] . '<br>';
        echo 'email => ' . $result['email'] . '<br>';
        echo 'password => ' . $result['password'] . '<br>';
        echo 'name => ' . $result['name'] . '<br>';
        */
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
