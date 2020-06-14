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
        foreach ($allCategories as $row) {
            $category = $categoryMapper->map($row);
            $categories[$category->getId($category)] = $category;
        }
        $this->resolveRelations($categories);
        return $categories;
    }

    public function resolveRelations($categories)
    {
        foreach ($categories as $key => $category) {
            if ($category->parentId > 0) {
                //var_dump($category);
                $parent = $categories[$category->getParentId($category)];
                $categories[$category->getParentId($category)]->addChild($category, $parent);
            }
        }
    }

    public function hasChildren($category){
        if (!empty($category->children)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

}
