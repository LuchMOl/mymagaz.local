<?php

namespace app\models;

class Product
{

    public $id;
    public $name;
    public $category = [];
    public $imageName = [];

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

    public function isChanged($editedProduct)
    {
        $name = $this->name == $editedProduct->name ? false : true;
        $categories = $this->isChangedCategories($editedProduct->category);
        $image = $this->isChangedImageName($editedProduct->imageName);
        return ($name OR $categories OR $image) ? true : false;
    }

    public function isChangedCategories($categories)
    {
        $categoryId = $this->extractCategoryId();
        return (empty(array_diff($categoryId, $categories)) AND empty(array_diff($categories, $categoryId))) ? false : true;
    }

    public function isChangedImage($uploadedFile)
    {
        if (is_file($uploadedFile['tmp_name'])) {
            if (!empty($this->imageName[0])) {
                $curentImageDir = '../web/images/products/';
                $curentImage = $curentImageDir . $this->imageName[0];
                $curent = hash_file('md5', $curentImage);
                $new = hash_file('md5', $uploadedFile['tmp_name']);
                $isChanged = strcmp($curent, $new) == 0 ? false : true;
            } else {
                $isChanged = true;
            }
        } else {
            $isChanged = false;
        }
        return $isChanged;
    }

    public function isChangedImageName($imageName)
    {
        $isChanged = $this->imageName[0] == $imageName[0] ? false : true;
        return $isChanged;
    }

    public function extractCategoryId()
    {
        if (!empty($this->category)) {
            foreach ($this->category as $category) {
                $id [] = $category->id;
            }
            $categoryId = $id;
        } else {
            $categoryId = [0, 0, 0];
        }
        return $categoryId;
    }

    public function isChangedContentProductsTable($editedProduct)
    {
        $isChanged = $this->name == $editedProduct->name ? false : true;
        return $isChanged;
    }

}
