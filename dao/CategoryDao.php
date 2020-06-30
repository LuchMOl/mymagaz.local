<?php

class CategoryDao extends BaseDao
{

    public function getRoots()
    {
        $sql = "SELECT * FROM categories WHERE parent_id = '0' ORDER BY rank DESC, name";
        return $this->getAll($sql);
    }

    public function getChildren($id)
    {
        $sql = "SELECT * FROM categories WHERE parent_id = $id ORDER BY rank DESC, name";
        return $this->getAll($sql);
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->getAll($sql);
    }

    public function getActivityCategories()
    {
        $sql = "SELECT * FROM categories WHERE activity = 1";
        return $this->getAll($sql);
    }

    public function insertNew($name, $parentId, $rank, $topMenu, $activity)
    {
        $sql = "INSERT INTO categories (name, parent_id, rank, top_menu, activity)"
                . "VALUES (:category, :parent_id, :rank, :top_menu, :activity)";
        $params = ['category' => $name, 'parent_id' => $parentId, 'rank' => $rank, 'top_menu' => $topMenu, 'activity' => $activity];
        return $this->execute($sql, $params);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->getOne($sql);
    }

    public function getTopMenu()
    {
        $sql = "SELECT * FROM categories WHERE top_menu = 1";
        $result = $this->getAll($sql);
        return $result;
    }

    public function eraseTopMenu()
    {
        $sql = "UPDATE categories SET top_menu = 0";
        return $this->execute($sql);
    }

    public function edit($id, $newName, $parentId, $rank, $topMenu, $activity)
    {
        $sql = 'UPDATE categories SET name = :newName, parent_id = :parentId, rank = :rank, top_menu = :topMenu, activity = :activity WHERE id = :id';
        $params = ['id' => $id, 'newName' => $newName, 'parentId' => $parentId, 'rank' => $rank, 'topMenu' => $topMenu, 'activity' => $activity];
        return $this->execute($sql, $params);
    }

}
