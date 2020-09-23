<?php

namespace app\controllers;

use app\services\colorService;

class colorController
{

    private $colorService;

    public function colorService()
    {
        if ($this->colorService === NULL) {
            $this->colorService = new colorService();
        }
        return $this->colorService;
    }

    public function actionIndex()
    {
        require_once '../views/product/color/index.php';
    }

    public function actionCreateNew()
    {
        $mesage = '';
        $title = 'Добавить новый цвет';

        if (isset($_POST['submitcolorForm'])) {
            if (!empty($_POST['colorName'])) {
                $isUpload = $this->colorService()->addcolor($_POST['colorName'], $_FILES['colorImage']);
                $mesage = $isUpload ? '' : 'Файл не перемещен.';
            } else {
                $mesage = 'Введите название цвета';
            }
        }

        require_once '../views/product/color/edit-create.php';
    }

    public function actionEdit()
    {
        $mesage = '';
        $title = 'Редактировать цвет';

        if (isset($_GET['editId'])) {

            $curentcolor = $this->colorService()->getcolorById($_GET['editId']);

            if (isset($_POST['submitcolorForm'])) {
                if (!empty($_POST['colorName'])) {
                    $editedcolor = ['id' => $curentcolor['id'],
                        'color' => $_POST['colorName'],
                        'colorImage' => $_FILES['colorImage']];
                    var_dump($editedcolor);
                    $isChanged = $this->colorService()->isChangedcolorEdit($curentcolor, $editedcolor);
                    if ($isChanged) {
                        $this->colorService()->editcolor();
                    }
                }
            }
        }
        require_once '../views/product/color/edit-create.php';
    }

    public function actionShowAll()
    {
        $mesage = '';
        $allcolors = $this->colorService()->getAllcolors();
        require_once '../views/product/color/showAll.php';
    }

}
