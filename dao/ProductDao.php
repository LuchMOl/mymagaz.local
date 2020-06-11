<?php

class ProductDao extends BaseDao
{

    public function GetColumnTable($column, $table)
    {
        $sql = "SELECT $column FROM $table ORDER BY id";
        return $this->GetColumn($sql);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->GetOne($sql);
    }

}
