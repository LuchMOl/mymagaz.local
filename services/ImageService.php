<?php

namespace app\services;

class ImageService
{

    private $imgName;
    private $extension;
    private $width;
    private $height;
    private $imgFileName;
    private $thrueName;

    public static function getImgFolderPath($dir)
    {
        return '/img/';
    }

    public static function getImgTag($imgName = '', $extension = '.png', $width = '250px', $height = '')
    {
        if (substr("$extension", 0, 1) !== '.') {
            $width = "$extension";
            $extension = '.png';
        }
        $imgFileName = "$imgName$extension";

        if (file_exists("../web/img/$imgFileName")) {
            $thrueName = $imgName;
        } else {
            $thrueName = 'error';
            $extension = '.png';
        }

        return "<img src=" . ImageService::getImgFolderPath() . $thrueName . $extension . " width=" . $width . " height=" . $height . ">";
    }

}

?>