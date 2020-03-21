<?php

class ProductController
{

    public function __construct()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        echo '<a href="http://mymagaz.local/product/list/">RenderList</a>'
        . '<a href="http://mymagaz.local/product/add/"><span style="margin-left: 50px">Add</span><br><br></a>';
    }

    function actionIndex()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

    function actionList()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

    function actionAdd()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';
    }

}
