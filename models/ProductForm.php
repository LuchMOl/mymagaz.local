<?php

namespace app\models;

class ProductForm
{

    public $id;
    public $name;
    public $categories = [];
    public $imageName;
    public $colors = [];
    public $sizes = [];
    public $price;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($data)
    {
        $this->name = $data['productName'];
    }

    public function setCategories($data)
    {
        if (isset($data['categories'])) {
            $this->categories = $data['categories'];
        } else {
            $this->categories = ['0' => 0];
        }
    }

    public function setImageName($data)
    {
        if (isset($data['imageName'])) {
            $this->imageName = $data['imageName'];
        } else {
            $this->imageName = '';
        }
    }

    public function setcolors($data)
    {
        if (isset($data['colorIds'])) {
            $this->colors = $data['colorIds'];
        } else {
            $this->colors = [];
        }
    }

    public function setSizes($data)
    {
        if (isset($data['sizeIds'])) {
            $this->sizes = $data['sizeIds'];
        } else {
            $this->sizes = [];
        }
    }

    public function setPrice($data)
    {
        if (!empty($data['price'])) {
            $this->price = $data['price'];
        } else {
            $this->price = 0;
        }
    }

}
