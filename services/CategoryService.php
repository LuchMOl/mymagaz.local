<?php

class CategoryService
{

    private $categoryDao;

    public function categoryDao()
    {
        if ($this->categoryDao === NULL) {
            $this->categoryDao = new CategoryDao();
        }
        return $this->categoryDao;
    }

    public function getColumnTable($column, $table)
    {
        return $this->categoryDao()->getColumnTable($column, $table);
    }

    public function getCategories($parents)
    {
        $categories = [];
        if ($parents === '') {
            $parents = $this->categoryDao()->getCategories('0');
        } elseif ($parents === 'top') {
            $parents = $this->categoryDao()->getCategoriesTopMenu();
        }
        foreach ($parents as $parent) {
            $seniorChildren = $this->categoryDao()->getCategories($parent['id']);
            $seniorCategories = [];
            foreach ($seniorChildren as $seniorChild) {
                if ($seniorChild['id'] !== 'none') {
                    $children = $this->categoryDao()->getCategories($seniorChild['id']);
                    $childCategorie = [];
                    foreach ($children as $child) {
                        $childCategorie = array_merge($childCategorie, [$child['name']]);
                    }
                }
                $seniorCategories = array_merge($seniorCategories, [$seniorChild['name'] => $childCategorie]);
            }
            $categories = array_merge($categories, [$parent['name'] => $seniorCategories]);
        }
        return $categories;
    }

    public function getAllCategoriesTopMenu()
    {
        $issetTopCategories = [];
        for ($i = 0; $i < 5; $i++) {
            $id = $this->categoryDao()->getCategoryTopMenu($i + 1);
            if (!$id) {
                $id = null;
            }
            $issetTopCategories = array_merge($issetTopCategories, [$id]);
        }
        return $issetTopCategories;
    }

    public function applyChoiceCategoriesForMenu($idTopCategories)
    {
        $issetTopCategories = $this->getAllCategoriesTopMenu();
        for ($i = 0; $i < 5; $i++) {
            if ($issetTopCategories[$i] !== $idTopCategories[$i]) {
                $this->categoryDao()->replaceThisCategory($i + 1, $idTopCategories[$i]);
            }
        }
    }

    public function getIdParentCategory($parent)
    {
        if (strpbrk($parent, '->')) {
            $parent = substr($parent, strpos($parent, '->') + 3);
            $idParentCategory = $this->categoryDao()->getIdParentCategory($parent);
        } else {
            $idParentCategory = $this->categoryDao()->getIdParentCategory($parent);
        }
        return $idParentCategory;
    }

    public function getIdCategory($category)
    {
        if (strpbrk($category, '->')) {
            $category = substr($category, strpos($category, '->') + 3);
            $idCategory = $this->categoryDao()->getIdCategory($category);
        } else {
            $idCategory = $this->categoryDao()->getIdCategory($category);
        }
        return $idCategory;
    }

    public function insertNewCategory($newCategory)
    {
        return $this->categoryDao()->insertNewCategory($newCategory);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        return $this->categoryDao()->insertNewCategoryWithParent($newCategory, $parentId);
    }

    public function parentsIsset($childId)
    {
        return $this->categoryDao()->parentsIsset($childId);
    }

    public function getCategoriesWithParent($categories)
    {
        $CategoriesWithParent = [];
        foreach ($categories as $category) {
            $parent = $this->categoryDao()->getParentName($category);
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
