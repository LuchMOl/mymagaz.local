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

    public function getAllcolors()
    {
        $allcolors = $this->colorDao()->getAllcolors();
        return $allcolors;
    }

    public function addcolor($colorName, $uploadedFile)
    {
        $this->uploadcolorImage($colorName, $uploadedFile);
        $this->colorDao()->insertImage($colorName);
    }

    public function uploadcolorImage($colorName, $uploadedFile)
    {
        if (file_exists($uploadedFile['tmp_name'])) {

            $colorImageExtention = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            $uploadedcolorFileName = $colorName . '.' . $colorImageExtention;
            $colorImageDestination = '../web/images/products/color' . $uploadedcolorFileName;

            return move_uploaded_file($uploadedFile['tmp_name'], $colorImageDestination);
        } else {
            $productImageName = 'no_photo.jpg';
        }
    }

    public function getcolorById($id)
    {
        $color = $this->colorDao()->getcolorById($id);
        $color = $this->checkcolorFileExistence($color);

        return $color;
    }

    public function checkcolorFileExistence($color)
    {

        $dir = 'images/products/colors/';
        $colorImage = $dir . $color['color'] . '.jpg';
        $color ['colorImage'] = file_exists($colorImage) ? $colorImage : $dir . 'no_photo.jpg';

        return $color;
    }

    public function isChangedcolorEdit($curentcolor, $editedcolor)
    {
        if ($curentcolor['color'] != $editedcolor['color']) {
            $this->colorDao()->eidtcolorName($editedcolor);
        } else {
            hash_file('md5', $curentcolor['colorImage']);
            hash_file('md5', $editedcolor);


            $curentcolorImage = $dir . $curentcolor['color'] . '.jpg';
            $editedcolorImage =

            hash_file('md5', 'image.png');
        }
        uploadcolorImage($colorName, $uploadedFile);
    }

}
