<?php

namespace app\models;

class Product
{

    public $id;
    public $name;
    public $categories = [];
    public $imageName;
    public $colours = [];
    public $sizes = [];
    public $price;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function addCategories($categories)
    {
        if (!is_string($categories[0])) {
            $this->categories [$categories->id] = $categories->name;
        } else {
            $this->categories = $categories;
        }
    }

    public function addImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function addColours($colours)
    {
        $this->colours = $colours;
    }

    public function addSizes($sizes)
    {
        $this->sizes = $sizes;
    }

    public function addColoursAndSizes($coloursAndSizes)
    {
        $colour = ['colourId' => $coloursAndSizes['colour_id'], 'colourName' => $coloursAndSizes['colour']];
        $size = ['sizeId' => $coloursAndSizes['size_id'], 'sizeName' => $coloursAndSizes['size']];
        $this->colours = [$colour];
        $this->sizes = [$size];
    }

    public function isChanged($editedProduct)
    {
        $nameWasChanged = $this->name != $editedProduct->name ? true : false;
        $categoriesWereChanged = $this->isChangedCategories($editedProduct->categories);
        $imageNameWasChanged = $this->isChangedImageName($editedProduct->imageName);
        $coloursWereChanged = $this->isChangedColours($editedProduct->colours);
        $sizesWereChanged = $this->isChangedSizes($editedProduct->sizes);
        $priceWasChanged = $this->isChangedPrice($editedProduct->price);
        $isChange = ($nameWasChanged || $categoriesWereChanged || $imageNameWasChanged || $coloursWereChanged || $sizesWereChanged || $priceWasChanged) ? true : false;
        return $isChange;
    }

    public function isChangedCategories($categories)
    {
        if (!empty($this->categories)) {
            foreach ($this->categories as $category) {
                $curentProductCategoriesId [] = $category->id;
            }
        } else {
            $curentProductCategoriesId [] = '0';
        }
        $isChangedCategories = (!empty(array_diff($curentProductCategoriesId, $categories)) || !empty(array_diff($categories, $curentProductCategoriesId))) ? true : false;
        return $isChangedCategories;
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
        $isChanged = $this->imageName[0] != $imageName[0] ? true : false;
        return $isChanged;
    }

    public function isChangedColours($colours)
    {
        if (!empty($this->colours[0])) {
            $isChanged = $this->colours[0]['colourId'] != $colours[0] ? true : false;
        } elseif (!empty($colours[0])) {
            $isChanged = true;
        } else {
            $isChanged = false;
        }
        return $isChanged;
    }

    public function isChangedSizes($sizes)
    {
        if (!empty($this->sizes[0])) {
            $isChanged = $this->sizes[0]['sizeId'] != $sizes[0] ? true : false;
        } elseif (!empty($sizes[0])) {
            $isChanged = true;
        } else {
            $isChanged = true;
        }
        return $isChanged;
    }

    public function isChangedPrice($price)
    {
        $isChanged = $this->price != $price ? true : false;
        return $isChanged;
    }

    public function isChangedContentProductsTable($editedProduct)
    {
        $isChangedProductName = $this->name != $editedProduct->name ? true : false;
        $isChangedProductPrice = $this->price != $editedProduct->price ? true : false;

        $isChange = ($isChangedProductName || $isChangedProductPrice) ? true : false;
        return $isChange;
    }

    public function getImgPath()
    {
        $imageDir = '/images/products/';
        return $imageDir . (empty($this->imageName) ? 'no_photo.jpg' : $this->imageName);
    }


}
