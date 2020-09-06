<?php

namespace app\controllers;

use app\services\SizeService;

class SizeController
{

    private $sizeService;

    public function sizeService()
    {
        if ($this->sizeService === NULL) {
            $this->sizeService = new SizeService();
        }
        return $this->sizeService;
    }

    public function actionIndex()
    {
        require_once '../views/product/size/index.php';
    }

    public function actionCreateNew()
    {

    }

    public function actionEdit()
    {

    }

    public function actionShowAll()
    {
        $mesage = '';
        $allSizes = $this->sizeService()->getAllSizes();
        require_once '../views/product/size/showAll.php';
    }

}
