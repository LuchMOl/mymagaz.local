<?php

class UserController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        StaticService::renderLinks();
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
