<?php

class CategoryDao extends BaseDao
{

    public function getCategories()
    {
        $sql = "SELECT * FROM categories";
        return $this->getAll($sql);
    }

    public function insertNewCategory($name, $parentId, $topMenu)
    {
        $sql = "INSERT INTO categories (name, parent_id, top_menu)"
                . "VALUES (:category, :parent_id, :top_menu)";
        $params = ['category' => $name, 'parent_id' => $parentId, 'top_menu' => $topMenu];
        return $this->execute($sql, $params);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        $sql = "INSERT INTO categories (name, parent_id)"
                . "VALUES (:name, :parent_id)";
        $params = ['name' => $newCategory, 'parent_id' => $parentId];
        return $this->execute($sql, $params);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->getOne($sql);
    }

    public function getCategoryTopMenu($id)
    {
        $sql = "SELECT category_id FROM top_menu WHERE id = $id";
        $result = $this->getOne($sql);
        return $result;
    }

    public function getCategoriesTopMenu()
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE id IN (SELECT category_id FROM top_menu)";
        $result = $this->getAll($sql);
        return $result;
    }

    public function insertCategoryTopMenu($id)
    {
        $sql = "UPDATE categories SET top_menu = 1 WHERE id = :id";
        $params = ['id' => $id];
        return $this->execute($sql, $params);
    }

    public function eraseCategoriesTopMenu()
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

    public function editCategory($id, $newCategoryName, $topMenu, $parentId)
    {
        $sql = 'UPDATE categories SET name = :newCategoryName, top_menu = :top_menu, parent_id = :parent_id WHERE id = :id';
        $params = ['id' => $id, 'newCategoryName' => $newCategoryName, 'top_menu' => $topMenu, 'parent_id' => $parentId];
        return $this->execute($sql, $params);
    }

}
