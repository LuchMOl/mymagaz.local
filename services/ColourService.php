<?php

namespace app\services;

use app\dao\ColourDao;

class ColourService
{

    private $colourDao;

    public function colourDao()
    {
        if ($this->colourDao === NULL) {
            $this->colourDao = new ColourDao();
        }
        return $this->colourDao;
    }

    public function getAllColours()
    {
        $allColours = $this->colourDao()->getAllColours();
        return $allColours;
    }

    public function addColour($colourName, $uploadedFile)
    {
        $this->uploadColourImage($colourName, $uploadedFile);
        $this->colourDao()->insertImage($colourName);
    }

    public function uploadColourImage($colourName, $uploadedFile)
    {
        if (file_exists($uploadedFile['tmp_name'])) {

            $colourImageExtention = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            $uploadedColourFileName = $colourName . '.' . $colourImageExtention;
            $colourImageDestination = '../web/images/products/colour' . $uploadedColourFileName;

            return move_uploaded_file($uploadedFile['tmp_name'], $colourImageDestination);
        } else {
            $productImageName = 'no_photo.jpg';
        }
    }

    public function getColourById($id)
    {
        $colour = $this->colourDao()->getColourById($id);
        $colour = $this->checkColourFileExistence($colour);

        return $colour;
    }

    public function checkColourFileExistence($colour)
    {

        $dir = 'images/products/colours/';
        $colourImage = $dir . $colour['colour'] . '.jpg';
        $colour ['colourImage'] = file_exists($colourImage) ? $colourImage : $dir . 'no_photo.jpg';

        return $colour;
    }

    public function isChangedColourEdit($curentColour, $editedColour)
    {
        if ($curentColour['colour'] != $editedColour['colour']) {
            $this->colourDao()->eidtColourName($editedColour);
        } else {
            hash_file('md5', $curentColour['colourImage']);
            hash_file('md5', $editedColour);


            $curentColourImage = $dir . $curentColour['colour'] . '.jpg';
            $editedColourImage =

            hash_file('md5', 'image.png');
        }
        uploadColourImage($colourName, $uploadedFile);
    }

}
