<?php

class UserController
{

    public function __construct()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        echo '<a href="http://mymagaz.local/user/login/">login</a>'
        . '<a href="http://mymagaz.local/user/create/"><span style="margin-left: 50px">create</span><br><br></a>';
    }

    function actionIndex()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

    function actionLogin()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

    function actionCreate()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

}
