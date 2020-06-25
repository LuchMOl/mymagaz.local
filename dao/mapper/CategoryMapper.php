<?php

class CategoryMapper
{

    public function map($data)
    {
        $category = new Category();

        $category->setId($data['id']);
        $category->setName($data['name']);
        $category->setParentId($data['parent_id']);
        $category->setTopMenu($data['top_menu']);
        $category->setRank($data['rank']);
        $category->setActivity($data['activity']);

        return $category;
    }

}

?>