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

    public function getCategories()
    {
        $categoryMapper = new CategoryMapper();
        $allCategories = $this->categoryDao()->getCategories();
        $categories = [];
        foreach ($allCategories as $row) {
            $category = $categoryMapper->map($row);
            $categories = array_merge($categories, [$category]);
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

    public function insertNewCategory($newCategory)
    {
        return $this->categoryDao()->insertNewCategory($newCategory);
    }

    public function insertNewCategoryWithParent($newCategory, $parentId)
    {
        return $this->categoryDao()->insertNewCategoryWithParent($newCategory, $parentId);
    }

}
