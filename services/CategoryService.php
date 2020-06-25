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

    public function getActivityCategories()
    {
        $categoryMapper = new CategoryMapper();
        $allCategories = $this->categoryDao()->getActivityCategories();
        foreach ($allCategories as $row) {
            $category = $categoryMapper->map($row);
            $categories[$category->getId($category)] = $category;
        }
        $this->resolveActivityRelations($categories);
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

    public function resolveActivityRelations($categories)
    {
        foreach ($categories as $category) {
            if ($category->parentId > 0) {

                foreach ($categories as $cat) {
                    if ($category->parentId == $cat->id) {
                        if ($cat->isActivity()) {
                            $parent = $categories[$category->parentId];
                            $parent->addChild($category);
                        }
                    }
                }
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
                    $tree["$id"] = $parent->name;
                    goto one;
                } else {
                    return array_reverse($tree, true);
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

    public function edit($id, $newCategoryName, $topMenu, $parentId)
    {
        return $this->categoryDao()->edit($id, $newCategoryName, $topMenu, $parentId);
    }

    public function editRank($id, $newRank, $activity)
    {
        return $this->categoryDao()->editRank($id, $newRank, $activity);
    }

    public function insertNew($name, $parentId, $topMenu)
    {
        return $this->categoryDao()->insertNew($name, $parentId, $topMenu);
    }

    public function eraseTopMenu()
    {
        return $this->categoryDao()->eraseTopMenu();
    }

    public function defineParentId($post, $get)
    {
        $post != 'none' ? $parentId = $post : $parentId = '';
        ($post == 'none' AND $get != '') ? $parentId = $get : '';
        ($post == 'none' AND $get == '') ? $parentId = 0 : '';
        return $parentId;
    }

    static function getSortRank($categories, $is)
    {
        if ($is != '') {
            foreach ($categories as $category) {
                if ($category->$is()) {
                    $arr [] = $category;
                }
            }
        } else {
            $arr = $categories;
        }
        $index = array();
        if (isset($arr)) {
            foreach ($arr as $a)
                $index[] = $a->rank;
            array_multisort($index, SORT_DESC, $arr);
            return $arr;
        }
    }

    static function getSortABC($arr)
    {
        $index = array();
        foreach ($arr as $a)
            $index[] = $a->name;
        array_multisort($index, $arr);

        return $arr;
    }

}
