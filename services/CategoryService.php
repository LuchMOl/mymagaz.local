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
        foreach ($categories as $category) {
            if ($category->parentId > 0) {
                $parent = $categories[$category->getParentId()];
                $parent->addChild($category);
            }
        }
    }

    static function getParent($categories, $parentId)
    {
        foreach ($categories as $category) {
            if ($category->id == $parentId) {
                return $category;
            }
        }
    }

    static function getHierarchyTree($categories, $id)
    {
        $tree = [];
        one :
        foreach ($categories as $category) {
            if ($category->id == $id) {
                if ($category->parentId != 0) {
                    $parent = self::getParent($categories, $category->parentId);
                    $id = $parent->id;
                    $tree [] = $parent->name;
                    goto one;
                } else {
                    return array_reverse($tree);
                    break;
                }
            }
        }
    }

    static function getRootParent($categories, $parentId)
    {
        foreach ($categories as $category) {
            if ($category->id == $parentId) {
                if ($category->hasParent()) {
                    return self::getRootParent($categories, $category->parentId);
                } else {
                    break;
                }
            }
        }
        return $category;
    }

    public function changeCategoriesTopMenu($newTopMenu)
    {
        if (!is_null($newTopMenu)) {
            $this->categoryDao()->eraseCategoriesTopMenu();
            $this->updateCategoriesTopMenu($newTopMenu);
        } else {
            $this->categoryDao()->eraseCategoriesTopMenu();
        }
    }

    public function updateCategoriesTopMenu($newTopMenu)
    {
        if (!empty($newTopMenu)) {
            foreach ($newTopMenu as $categoryId) {
                $this->categoryDao()->insertCategoryTopMenu($categoryId);
            }
        }
    }

    public function editCategory($id, $newCategoryName, $topMenu, $parentId)
    {
        return $this->categoryDao()->editCategory($id, $newCategoryName, $topMenu, $parentId);
    }

    public function insertNewCategory($name, $parentId, $topMenu)
    {
        return $this->categoryDao()->insertNewCategory($name, $parentId, $topMenu);
    }

    public function defineParentId($post, $get)
    {
        $post != 'none' ? $parentId = $post : $parentId = '';
        ($post == 'none' AND $get != '') ? $parentId = $get : '';
        ($post == 'none' AND $get == '') ? $parentId = 0 : '';
        return $parentId;
    }

}
