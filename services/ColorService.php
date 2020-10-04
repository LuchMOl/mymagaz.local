<?php

namespace app\services;

use app\dao\colorDao;

class colorService
{

    private $colorDao;

    public function colorDao()
    {
        if ($this->colorDao === NULL) {
            $this->colorDao = new colorDao();
        }
        return $this->colorDao;
    }

    public function getAllColors()
    {
        $allColors = $this->colorDao()->getAllColors();
        return $allColors;
    }

    public function addColor($colorName, $uploadedFile)
    {
        $this->uploadColorImage($colorName, $uploadedFile);
        $this->colorDao()->insertImage($colorName);
    }

    public function uploadColorImage($colorName, $uploadedFile)
    {
        if (file_exists($uploadedFile['tmp_name'])) {

            $colorImageExtention = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            $uploadedColorFileName = $colorName . '.' . $colorImageExtention;
            $colorImageDestination = '../web/images/products/color' . $uploadedColorFileName;

            return move_uploaded_file($uploadedFile['tmp_name'], $colorImageDestination);
        } else {
            $productImageName = 'no_photo.jpg';
        }
    }

    public function getColorById($id)
    {
        $color = $this->colorDao()->getColorById($id);
        $color = $this->checkColorFileExistence($color);

        return $color;
    }

    public function checkColorFileExistence($color)
    {

        $dir = 'images/products/colors/';
        $colorImage = $dir . $color['color'] . '.jpg';
        $color ['colorImage'] = file_exists($colorImage) ? $colorImage : $dir . 'no_photo.jpg';

        return $color;
    }

    public function isChangedColorEdit($curentColor, $editedColor)
    {
        if ($curentColor['color'] != $editedColor['color']) {
            $this->colorDao()->eidtColorName($editedColor);
        } else {
            hash_file('md5', $curentColor['colorImage']);
            hash_file('md5', $editedColor);


            $curentColorImage = $dir . $curentColor['color'] . '.jpg';
            $editedColorImage = hash_file('md5', 'image.png');
        }
        uploadColorImage($colorName, $uploadedFile);
    }

}
