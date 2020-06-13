<?php

class CategoryDao extends BaseDao
{
    /*    public function getIdTableKeyParam($table, $key, $param)
      {
      $sql = "SELECT id FROM $table WHERE $key = '$param'";
      return $this->GetOne($sql);
      }
     */

    public function getColumnTable($column, $table)
    {
        $sql = "SELECT $column FROM $table ORDER BY id";
        return $this->getColumn($sql);
    }

    public function insertNewCategory($newCategory)
    {
        $sql = "INSERT INTO categories (name)"
                . "VALUES (:category)";
        $params = ['category' => $newCategory];
        return $this->execute($sql, $params);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        $sql = "INSERT INTO categories (name, parent_id)"
                . "VALUES (:name, :parent_id)";
        $params = ['name' => $newCategory, 'parent_id' => $parentId];
        return $this->execute($sql, $params);
    }

    public function editCategory($oldCategoryName, $newCategoryName)
    {
        $sql = 'UPDATE categories SET name = :newCategoryName WHERE name = :oldCategoryName';
        $params = ['oldCategoryName' => $oldCategoryName, 'newCategoryName' => $newCategoryName];
        return $this->execute($sql, $params);
    }

    public function deleteCategory($category)
    {
        $sql = 'DELETE FROM categories WHERE name = :category';
        $params = ['category' => $category];
        return $this->execute($sql, $params);
    }

    public function checkOne($table, $column, $item)
    {
        $sql = "SELECT id FROM $table WHERE $column = '$item'";
        return $this->getOne($sql);
    }

    public function parentsIsset($childId)
    {
        $sql = "SELECT name FROM categories WHERE parent_id = '$childId'";
        return $this->getOne($sql);
    }

    public function getParentName($childName)
    {
        $sql = "SELECT name FROM categories WHERE id = (SELECT parent_id FROM categories WHERE name = '$childName')";
        $result = $this->getOne($sql);
        if (!$result) {
            $result = 'Нет родителя';
        }
        return $result;
    }

    public function getIdCategory($name)
    {
        //var_dump($parentName);
        $sql = "SELECT id FROM categories WHERE name = '$name'";
        if (!$result = $this->getOne($sql)) {
            $result = null;
        }
        return $result;
    }

    public function getIdParentCategory($parentName)
    {
        //var_dump($parentName);
        $sql = "SELECT id FROM categories WHERE name = '$parentName'";
        return $this->getOne($sql);
    }

    public function getCategory($Id)
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE id = '$Id'";
        $result = $this->getRow($sql);
        if (!is_array($result)) {
            $result = ['id' => 'none', 'name' => 'none', 'parent_id' => 'none'];
        }
        return $result;
    }

    public function getCategories($parentId)
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE parent_id = '$parentId'";
        $result = $this->getAll($sql);
        if (!is_array($result)) {
            $result = ['id' => 'none', 'name' => 'none', 'parent_id' => 'none'];
        }
        return $result;
    }

    public function getNameCategory($id)
    {
        $sql = "SELECT id, name, parent_id FROM categories WHERE id = '$id'";
        $result = $this->getAll($sql);
        if (!is_array($result)) {
            $result = ['id' => 'none', 'name' => 'none', 'id' => 'none'];
        }
        return $result;
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

    public function insertCategoriesTopMenu($id)
    {
        $sql = "INSERT INTO top_menu (category_id)"
                . "VALUES (:category_id)";
        $params = ['category_id' => $id];
        return $this->execute($sql, $params);
    }

    public function replaceThisCategory($id, $category_id)
    {
        $sql = 'UPDATE top_menu SET category_id = :category_id WHERE id = :id';
        $params = ['id' => $id, 'category_id' => $category_id];
        return $this->execute($sql, $params);
    }

}
