<?php

class ProductService
{

    private $productDao;

    public function productDao()
    {
        if ($this->productDao === NULL) {
            $this->productDao = new ProductDao();
        }
        return $this->productDao;
    }

    public function GetColumnTable($column, $table)
    {
        return $this->productDao()->GetColumnTable($column, $table);
    }

    public function insertNewCategory($newCategory)
    {
        return $this->productDao()->insertNewCategory($newCategory);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        return $this->productDao()->insertNewCategoryWithParent($newCategory, $parentId);
    }

    public function GetIdIssetItem($table, $column, $item)
    {
        return $this->productDao()->getIdTableKeyParam($table, $column, $item);
    }

    public function ParentsIsset($childId)
    {
        return $this->productDao()->ParentsIsset($childId);
    }

    public function getCategoriesWithParent($categories)
    {
        $CategoriesWithParent = [];
        foreach ($categories as $category) {
            $parent = $this->productDao()->GetParentName($category);
            $CategoriesWithParent = array_merge($CategoriesWithParent, ["$category" => "$parent"]);
        }
        return $CategoriesWithParent;
    }

    public function deleteCategory($category)
    {
        return $this->productDao()->deleteCategory($category);
    }

    public function editCategory($oldCategoryName, $newCategoryName)
    {
        return $this->productDao()->editCategory($oldCategoryName, $newCategoryName);
    }

    static function uploadImages($data)
    {
        $images = [];
        for ($i = 0; $i < count($data['name']); $i++) {
            $extension = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
            $tmp_name = $data['tmp_name'][$i];
            $fileName = uniqid() . $i . '.' . $extension;
            move_uploaded_file($tmp_name, '../web/images/products/' . $fileName);
            array_push($images, $fileName);
        }
        return $images;
    }

}
