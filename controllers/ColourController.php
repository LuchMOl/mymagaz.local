<?php

namespace app\controllers;

use app\services\ColourService;

class ColourController
{

    private $colourService;

    public function colourService()
    {
        if ($this->colourService === NULL) {
            $this->colourService = new ColourService();
        }
        return $this->colourService;
    }

    public function actionIndex()
    {
        require_once '../views/product/colour/index.php';
    }

    public function actionCreateNew()
    {
        $mesage = '';
        $title = 'Добавить новый цвет';

        if (isset($_POST['submitColourForm'])) {
            if (!empty($_POST['colourName'])) {
                $isUpload = $this->colourService()->addColour($_POST['colourName'], $_FILES['colourImage']);
                $mesage = $isUpload ? '' : 'Файл не перемещен.';
            } else {
                $mesage = 'Введите название цвета';
            }
        }

        require_once '../views/product/colour/edit-create.php';
    }

    public function actionEdit()
    {
        $mesage = '';
        $title = 'Редактировать цвет';

        if (isset($_GET['editId'])) {

            $curentColour = $this->colourService()->getColourById($_GET['editId']);

            if (isset($_POST['submitColourForm'])) {
                if (!empty($_POST['colourName'])) {
                    $editedColour = ['id' => $curentColour['id'],
                        'colour' => $_POST['colourName'],
                        'colourImage' => $_FILES['colourImage']];
                    var_dump($editedColour);
                    $isChanged = $this->colourService()->isChangedColourEdit($curentColour, $editedColour);
                    if ($isChanged) {
                        $this->colourService()->editColour();
                    }
                }
            }
        }
        require_once '../views/product/colour/edit-create.php';
    }

    public function actionShowAll()
    {
        $mesage = '';
        $allColours = $this->colourService()->getAllColours();
        require_once '../views/product/colour/showAll.php';
    }

}
