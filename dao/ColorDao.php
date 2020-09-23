<?php

namespace app\dao;

class colorDao extends BaseDao
{

    public function getAllcolors()
    {
        $sql = "SELECT * FROM colors";
        $allcolors = $this->getAll($sql);
        return $allcolors;
    }

    public function insertImage($colorName)
    {
        $sql = 'INSERT INTO colors (color) VALUES (:color)';
        $params = ['color' => $colorName];
        $write = $this->execute($sql, $params);
        return $write;
    }

    public function getcolorById($id)
    {
        $sql = "SELECT * FROM colors WHERE id = '$id'";
        $color = $this->getRow($sql);
        return $color;
    }

}
