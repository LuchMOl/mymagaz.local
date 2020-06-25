<?php

class CategoryDao extends BaseDao
{

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

    public function insertNew($name, $parentId, $topMenu)
    {
        $sql = "INSERT INTO categories (name, parent_id, top_menu)"
                . "VALUES (:category, :parent_id, :top_menu)";
        $params = ['category' => $name, 'parent_id' => $parentId, 'top_menu' => $topMenu];
        return $this->execute($sql, $params);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->getOne($sql);
    }

    public function getTopMenu()
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE id IN (SELECT category_id FROM top_menu)";
        $result = $this->getAll($sql);
        return $result;
    }

    public function eraseTopMenu()
    {
        $sql = "UPDATE categories SET top_menu = 0";
        return $this->execute($sql);
    }

    public function replaceThisCategory($id, $category_id)
    {
        $sql = 'UPDATE top_menu SET category_id = :category_id WHERE id = :id';
        $params = ['id' => $id, 'category_id' => $category_id];
        return $this->execute($sql, $params);
    }

    public function edit($id, $newName, $topMenu, $parentId)
    {
        $sql = 'UPDATE categories SET name = :newName, top_menu = :top_menu, parent_id = :parent_id WHERE id = :id';
        $params = ['id' => $id, 'newName' => $newName, 'top_menu' => $topMenu, 'parent_id' => $parentId];
        return $this->execute($sql, $params);
    }

    public function editRank($id, $newRank, $activity)
    {
        $sql = 'UPDATE categories SET rank = :rank, activity = :activity WHERE id = :id';
        $params = ['id' => $id, 'rank' => $newRank, 'activity' => $activity];
        return $this->execute($sql, $params);
    }

}
