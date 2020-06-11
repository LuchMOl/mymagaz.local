<?php

class CategoryDao extends BaseDao
{
    /*    public function getIdTableKeyParam($table, $key, $param)
      {
      $sql = "SELECT id FROM $table WHERE $key = '$param'";
      return $this->GetOne($sql);
      }
     */

    public function GetColumnTable($column, $table)
    {
        $sql = "SELECT $column FROM $table ORDER BY id";
        return $this->GetColumn($sql);
    }

    public function insertNewCategory($newCategory)
    {
        $sql = "INSERT INTO categories (name)"
                . "VALUES (:category)";
        $params = ['category' => $newCategory];
        return $this->Execute($sql, $params);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        $sql = "INSERT INTO categories (name, parent_id)"
                . "VALUES (:name, :parent_id)";
        $params = ['name' => $newCategory, 'parent_id' => $parentId];
        return $this->Execute($sql, $params);
    }

    public function editCategory($oldCategoryName, $newCategoryName)
    {
        $sql = 'UPDATE categories SET name = :newCategoryName WHERE name = :oldCategoryName';
        $params = ['oldCategoryName' => $oldCategoryName, 'newCategoryName' => $newCategoryName];
        return $this->Execute($sql, $params);
    }

    public function deleteCategory($category)
    {
        $sql = 'DELETE FROM categories WHERE name = :category';
        $params = ['category' => $category];
        return $this->Execute($sql, $params);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->GetOne($sql);
    }

    public function ParentsIsset($childId)
    {
        $sql = "SELECT name FROM categories WHERE parent_id = '$childId'";
        return $this->GetOne($sql);
    }

    public function GetParentName($childName)
    {
        $sql = "SELECT name FROM categories WHERE id = (SELECT parent_id FROM categories WHERE name = '$childName')";
        $result = $this->GetOne($sql);
        if (!$result) {
            $result = 'Нет родителя';
        }
        return $result;
    }

    public function GetIdParentCategory($parentName)
    {
        //var_dump($parentName);
        $sql = "SELECT id FROM categories WHERE name = '$parentName'";
        return $this->GetOne($sql);
    }

    public function GetCategories($parentId)
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE parent_id = '$parentId'";
        $result = $this->GetAll($sql);
        if (!is_array($result)) {
            $result = ['id' => 'none', 'name' => 'none', 'parent_id' => 'none'];
        }
        return $result;
    }

}
