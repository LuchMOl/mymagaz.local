<?php

class ImageService
{

    var $imgName;
    var $extension;
    var $width;
    var $height;
    var $dir;
    var $imgFileName;
    var $thrueName;

    public static function getImgFolderPath()
    {
        return '/img/';
    }

    public static function getImgTag($imgName = '', $extension = '.png', $width = '250px', $height = '')
    {
        //проверка является ли $extension расширением (начинается ли строка с точки)
        //если нет - значит принять вторую переданную переменную за $width, оставив $extension по умолчанию
        if (substr("$extension", 0, 1) !== '.') {
            $width = "$extension";
            $extension = '.png';
        }
/*
        //проверка на наличие запрашиваемого файла в папке
        $dir = '../web/img/';
        $imgFileName = "$imgName$extension";
        if (in_array($imgFileName, scandir("$dir"))) {
            $thrueName = $imgName;
        } else {
            $thrueName = 'error';
            $extension = '.png';
        }
 */
        return "<img src=" . ImageService::getImgFolderPath() . $imgName . $extension . " width=" . $width . " height=" . $height . ">";
    }

}

?>