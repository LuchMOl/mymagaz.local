<?php

namespace app\dao;

class SizeDao extends BaseDao
{

    public function getAllSizes()
    {
        $sql = "SELECT * FROM sizes";
        $allSizes = $this->getAll($sql);
        return $allSizes;
    }

}
