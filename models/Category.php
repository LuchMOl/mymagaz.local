<?php

class Category
{

    public $id;
    public $name;
    public $parentId;

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

    public function getId($category)
    {
        return $category->id;
    }

    public function getName($category)
    {
        return $category->name;
    }

    public function getParentId($category)
    {
        return $category->parentId;
    }

}

?>