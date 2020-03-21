<?php

class AutoLoadServices
{

    private $counter;
    private $dir;
    private $arrs;
    private $arr;

    public function __construct()
    {
        $dir = '../services/';
        $arrs = scandir($dir);
        $counter = 0;
        foreach ($arrs as $arr) {

            if ($counter > 1 && $arr !== 'AutoLoadServices.php') {

                require "$dir$arr";
            }
            $counter++;
        }
    }

}
?>
