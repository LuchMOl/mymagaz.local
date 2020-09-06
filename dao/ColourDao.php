<?php

namespace app\dao;

class ColourDao extends BaseDao
{

    public function getAllColours()
    {
        $sql = "SELECT * FROM colours";
        $allColours = $this->getAll($sql);
        return $allColours;
    }

    public function insertImage($colourName)
    {
        $sql = 'INSERT INTO colours (colour) VALUES (:colour)';
        $params = ['colour' => $colourName];
        $write = $this->execute($sql, $params);
        return $write;
    }

    public function getColourById($id)
    {
        $sql = "SELECT * FROM colours WHERE id = '$id'";
        $colour = $this->getRow($sql);
        return $colour;
    }

}
