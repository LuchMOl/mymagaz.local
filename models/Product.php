<?php

namespace app\models;

class Product
{

    public $id;
    public $name;
    public $categories = [];
    public $imageName;
    public $colors = [];
    public $sizes = [];
    public $price;
    public $orderCart = [];
    public $orderColor = [];
    public $orderSize = [];

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

    public function addColors($colors)
    {
        foreach ($colors as $color) {
            $this->colors [$color['id']] = $color['color'];
        }
    }

    public function addSizes($sizes)
    {
        foreach ($sizes as $size) {
            $this->sizes [$size['id']] = $size['size'];
        }
    }

    public function addOrderCart($productCartForm)
    {
        $this->orderCart = $productCartForm;
    }

    public function addQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function isChanged($editedProduct)
    {
        $nameWasChanged = $this->name != $editedProduct->name ? true : false;
        $categoriesWereChanged = $this->isChangedCategories($editedProduct->categories);
        $imageNameWasChanged = $this->isChangedImageName($editedProduct->imageName);
        $colorsWereChanged = $this->isChangedcolors($editedProduct->colors);
        $sizesWereChanged = $this->isChangedSizes($editedProduct->sizes);
        $priceWasChanged = $this->isChangedPrice($editedProduct->price);
        $isChange = ($nameWasChanged || $categoriesWereChanged || $imageNameWasChanged || $colorsWereChanged || $sizesWereChanged || $priceWasChanged) ? true : false;
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

    public function isChangedcolors($colors)
    {
        if (!empty($this->colors[0])) {
            $isChanged = $this->colors[0]['colorId'] != $colors[0] ? true : false;
        } elseif (!empty($colors[0])) {
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
