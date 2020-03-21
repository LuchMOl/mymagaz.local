<?php

class ProductController
{

    function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        StaticService::renderLinks();
    }

    function actionList()
    {
        echo __METHOD__ . '<br><br>';
    }

    function actionAdd()
    {
        echo __METHOD__ . '<br><br>';
    }

}
