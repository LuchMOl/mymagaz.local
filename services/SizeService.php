<?php

namespace app\services;

use app\dao\SizeDao;

class SizeService
{

    private $sizeDao;

    public function sizeDao()
    {
        if ($this->sizeDao === NULL) {
            $this->sizeDao = new SizeDao();
        }
        return $this->sizeDao;
    }

    public function getAllSizes()
    {
        $allSizes = $this->sizeDao()->getAllSizes();
        return $allSizes;
    }

}