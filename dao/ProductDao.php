<?php

class ProductDao extends BaseDao
{

    public function getColumnTable($column, $table)
    {
        $sql = "SELECT $column FROM $table ORDER BY id";
        return $this->getColumn($sql);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->getOne($sql);
    }

}
