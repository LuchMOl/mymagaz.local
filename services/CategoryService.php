<?php

class CategoryService
{

    private $categoryDao;

    public function categoryDao()
    {
        if ($this->categoryDao === NULL) {
            $this->categoryDao = new categoryDao();
        }
        return $this->categoryDao;
    }

    public function GetColumnTable($column, $table)
    {
        return $this->categoryDao()->GetColumnTable($column, $table);
    }

    public function GetCategories()
    {
        $Categories = [];
        $parents = $this->categoryDao()->GetCategories('0');
        foreach ($parents as $parent) {
            $SeniorChildren = $this->categoryDao()->GetCategories($parent['id']);
            $SeniorCategories = [];
            foreach ($SeniorChildren as $SeniorChild) {
                if ($SeniorChild['id'] !== 'none') {
                    $Children = $this->categoryDao()->GetCategories($SeniorChild['id']);
                    $ChildCategorie = [];
                    foreach ($Children as $Child) {
                        $ChildCategorie = array_merge($ChildCategorie, [$Child['name']]);
                    }
                }
                $SeniorCategories = array_merge($SeniorCategories, [$SeniorChild['name'] => $ChildCategorie]);
            }
            $Categories = array_merge($Categories, [$parent['name'] => $SeniorCategories]);
        }
        return $Categories;
    }

    public function GetIdParentCategory($parent)
    {
        if (strpbrk($parent, '->')) {
            $parent = substr($parent, strpos($parent, '->') + 3);
            $idParentCategory = $this->categoryDao()->GetIdParentCategory($parent);
        } else {
            $idParentCategory = $this->categoryDao()->GetIdParentCategory($parent);
        }
        return $idParentCategory;
    }

    public function insertNewCategory($newCategory)
    {
        return $this->categoryDao()->insertNewCategory($newCategory);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        return $this->categoryDao()->insertNewCategoryWithParent($newCategory, $parentId);
    }

    public function ParentsIsset($childId)
    {
        return $this->categoryDao()->ParentsIsset($childId);
    }

    public function getCategoriesWithParent($categories)
    {
        $CategoriesWithParent = [];
        foreach ($categories as $category) {
            $parent = $this->categoryDao()->GetParentName($category);
            $CategoriesWithParent = array_merge($CategoriesWithParent, ["$category" => "$parent"]);
        }
        return $CategoriesWithParent;
    }

    public function deleteCategory($category)
    {
        return $this->categoryDao()->deleteCategory($category);
    }

    public function editCategory($oldCategoryName, $newCategoryName)
    {
        return $this->categoryDao()->editCategory($oldCategoryName, $newCategoryName);
    }

}
