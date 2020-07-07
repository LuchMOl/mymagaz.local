<?php

class Category
{

    public $id;
    public $name;
    public $parentId;
    public $topMenu;
    public $children = [];

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function setTopMenu($topMenu)
    {
        $this->topMenu = $topMenu;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getTopMenu()
    {
        return $this->topMenu;
    }

    public function addChild($category)
    {
        $this->children [] = $category;
    }

    public function hasParent()
    {
        $this->parentId == 0 ? $res = false : $res = true;
        return $res;
    }

    public function hasChildren()
    {
        empty($this->children) ? $res = false : $res = true;
        return $res;
    }

    public function childrenHasChildren()
    {
        foreach ($this->children as $children) {
            if (!empty($children->children)) {
                return true;
            }
        }
    }

    public function isTopMenu()
    {
        if ($this->topMenu == 1) {
            return true;
        }
    }

    public function isRoot()
    {
        if ($this->parentId == 0) {
            return true;
        }
    }

    public function isActivity()
    {
        if ($this->activity == 1) {
            return true;
        }
    }

    public function isChanged($newCategoryName, $parentId, $rank, $checkTopMenu, $checkActivity)
    {
        //var_dump($newCategoryName, $parentId, $rank, $checkTopMenu, $checkActivity);
        $name = $this->name == $newCategoryName ? false : true;
        $parentId = $parentId == $this->parentId ? false : true;
        $rank = $this->rank == $rank ? false : true;
        $checkTopMenu = $this->topMenu == $checkTopMenu ? false : true;
        $checkActivity = $this->activity == $checkActivity ? false : true;

        return ($name OR $parentId OR $rank OR $checkTopMenu OR $checkActivity) ? true : false;
        //var_dump($res); exit();
    }

}
