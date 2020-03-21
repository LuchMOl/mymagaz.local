<?php

class StaticService
{

    static function getFilesNames($dir)
    //возвращает масиив с именами файлов в папке $dir
    {
        return scandir($dir);
    }

    static function printClassMethodName()
    {
        echo __CLASS__;
        echo '<br>';
        echo __METHOD__;
        echo '<br><br>';
    }

}
