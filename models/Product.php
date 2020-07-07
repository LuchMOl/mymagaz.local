<?php

class Product
{

    public $id;
    public $name;
    public $category = [];

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addCategory($category)
    {
        $this->category [$category->id] = $category->name;
    }

    public function isChanged($newName, $categories)
    {
        //var_dump($newName, $categories, $this);
        //exit();
        $name = $this->name == $newName ? false : true;
        $categoryId = $this->extractCategoryId();
        $category = (empty(array_diff($categoryId, $categories)) AND empty(array_diff($categories, $categoryId))) ? false : true;

        return ($name OR $category) ? true : false;
        //var_dump($res);
        //exit();
    }

    public function extractCategoryId()
    {
        if (!empty($this->category)) {
            foreach ($this->category as $category) {
                $id [] = $category->id;
            }
            $categoryId = $id;
        }else{
            $categoryId = [0, 0, 0];
        }
        return $categoryId;
    }

}
