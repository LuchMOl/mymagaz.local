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

    public function isChanged($newCategoryName, $checkbox, $parentId)
    {
        $parentId == 'none' OR $parentId == $this->parentId ? $parentId = false : $parentId = true;
        $this->name == $newCategoryName ? $name = false : $name = true;
        $this->topMenu == $checkbox ? $topMenu = false : $topMenu = true;
        return $name OR $topMenu OR $parentId ? true : false;
    }

    public function isChangedRank($rank, $activity)
    {
        $this->rank == $rank ? $rank = false : $rank = true;
        $this->activity == $activity ? $activity = false : $activity = true;
        return $rank OR $activity ? true : false;
    }

}
