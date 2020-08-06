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
                $parent = $categories[$category->parentId];
                $parent->addChild($category);
            }
        }
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

    public function getTopMenu()
    {
        $categoryMapper = new CategoryMapper();
        $topMenu = $this->categoryDao()->getTopMenu();
        if (!empty($topMenu)) {
            foreach ($topMenu as $row) {
                $category = $categoryMapper->map($row);
                $categories[$category->getId($category)] = $category;
            }
            return $categories;
        }
    }

    static function getCategoryById($categories, $id)
    {
        foreach ($categories as $category) {
            if ($category->id == $id) {
                return $category;
                break;
            }
        }
    }

    static function getHierarchyTree($categories, $id, $tree)
    {
        foreach ($categories as $category) {
            if ($category->id == $id) {
                $tree["$category->id"] = $category;
                if ($category->hasParent()) {
                    return self::getHierarchyTree($categories, $category->parentId, $tree);
                } else {
                    break;
                }
            }
        }
        $tree = array_reverse($tree, true);
        array_pop($tree);
        return $tree;
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

    public function edit($id, $newCategoryName, $parentId, $rank, $checkTopMenu, $checkActivity)
    {
        return $this->categoryDao()->edit($id, $newCategoryName, $parentId, $rank, $checkTopMenu, $checkActivity);
    }

    public function insertNew($name, $parentId, $rank, $topMenu, $activity)
    {
        return $this->categoryDao()->insertNew($name, $parentId, $rank, $topMenu, $activity);
    }

    public function eraseTopMenu()
    {
        return $this->categoryDao()->eraseTopMenu();
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
            foreach ($arr as $a) {
                $index[] = $a->rank;
            }
            array_multisort($index, SORT_DESC, $arr);
            return $arr;
        }
    }

    static function getSortABC($arr)
    {
        $index = array();
        foreach ($arr as $a) {
            $index[] = $a->name;
        }
        array_multisort($index, $arr);

        return $arr;
    }

    public function getRoots()
    {
        $categoryMapper = new CategoryMapper();
        $roots = $this->categoryDao()->getRoots();
        foreach ($roots as $row) {
            $category = $categoryMapper->map($row);
            $categories[$category->id] = $category;
        }

        return $categories;
    }

    public function getParentId($childrenId)
    {
        return $this->categoryDao()->getParentId($childrenId);
    }

    public function getChildren($id)
    {
        $categoryMapper = new CategoryMapper();
        $children = $this->categoryDao()->getChildren($id);
        if (!empty($children)) {
            foreach ($children as $row) {
                $category = $categoryMapper->map($row);
                $categories[$category->id] = $category;
            }
        } else {
            $categories = [];
        }
        return $categories;
    }

    public function getEmptyCategory()
    {
        $categoryMapper = new CategoryMapper();
        $row = ['id' => '', 'name' => '', 'parent_id' => '', 'top_menu' => '', 'rank' => '', 'activity' => ''];
        $category = $categoryMapper->map($row);
        return $category;
    }

    public function renderShowAll($categories)
    {
        foreach ($categories as $category) {
            $space = 0;
            include '..\views\product\category\template.php';
            $this->renderCildren($category->id, $space);
        }
    }

    public function renderCildren($id, $space)
    {
        $space = $space + 30;
        $children = $this->getChildren($id);
        if (!empty($children)) {
            foreach ($children as $category) {
                include '..\views\product\category\template.php';
                $this->renderCildren($category->id, $space);
            }
        }
    }

    public function selectAll()
    {
        $space = '';
        $categories = $this->getRoots();

        foreach ($categories as $category) {
            if (isset($_GET['editId']) AND $_GET['editId'] != $category->id) {
                $parentId = $this->getParentId($_GET['editId']);
                $selected = $category->id == $parentId ? 'selected' : '';
                echo "<optgroup label='$category->name'><option value = '$category->id' $selected>$space$category->name</option></optgroup>";
            } elseif ($_GET['editId'] != $category->id) {
                echo "<optgroup label='$category->name'><option value = '$category->id'>$space$category->name</option></optgroup>";
            }
            $this->selectCildren($category->id, $parentId, $space);
        }
    }

    public function selectCildren($id, $parentId, $space)
    {
        $space = $space . '-&nbsp&nbsp&nbsp&nbsp';
        $children = $this->getChildren($id);
        if (!empty($children)) {
            foreach ($children as $category) {
                if (isset($_GET['editId']) AND $_GET['editId'] != $category->id AND $category->id == $parentId) {
                    echo "<option value = '$category->id' selected>$space$category->name</option>";
                } elseif ($_GET['editId'] != $category->id) {
                    echo "<option value = '$category->id'>$space$category->name</option>";
                }
                $this->selectCildren($category->id, $parentId, $space);
            }
        }
    }

}
