<?php

class ProductService
{

    private $productDao;

    public function productDao()
    {
        if ($this->productDao === NULL) {
            $this->productDao = new ProductDao();
        }
        return $this->productDao;
    }

    public function GetProduct($name, $value)
    {
        $product = $this->productDao()->GetProduct($name, $value);
        $colours = $this->productDao()->GetColoursQuantity($product['id']);
        $categories = $this->productDao()->GetCategories($product['id']);
        return $this->constituteProduct($product, $colours, $categories);
    }

    public function GetNameAndImagesOfProduct()
    {
        $products = $this->productDao()->GetNameAndImagesOfProduct();
        if (!empty($products)) {
            foreach ($products as $product) {
                $result[] = array_merge($this->rebuildProduct($product));
            }
            return $result;
        } else {
            return false;
        }
    }

    public function GetColumnTable($column, $table)
    {
        return $this->productDao()->GetColumnTable($column, $table);
    }

    public function insertNewColour($newColour)
    {
        if ($this->productDao()->insertNewColour($newColour)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertNewCategory($newCategory)
    {
        return $this->productDao()->insertNewCategory($newCategory);
    }

    public function checkIssetItem($table, $column, $item)
    {
        return $this->productDao()->checkOne($table, $column, $item);
    }

    public function deleteCategory($category)
    {
        return $this->productDao()->deleteCategory($category);
    }
    public function editCategory($oldCategoryName, $newCategoryName){
        return $this->productDao()->editCategory($oldCategoryName, $newCategoryName);
    }

    public function insertNewProduct($newProduct)
    {
        $productId = $this->productDao()->insertNewProduct($newProduct);
        if (is_numeric($productId)) {
            return $productId;
        } else {
            return false;
        }
    }

    public function insertColourQuantityOfNewProduct($productId, $colours)
    {
        $counterTrue = 0;
        foreach ($colours as $colour => $quantity) {
            if ($this->productDao()->insertColourQuantityOfNewProduct($productId, $colour, $quantity)) {
                $counterTrue++;
            }
        }
        if ($counterTrue == count($colours)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertCategoryOfNewProduct($productId, $categories)
    {
        $counterTrue = 0;
        foreach ($categories as $category) {
            if ($this->productDao()->insertCategoryOfNewProduct($productId, $category)) {
                $counterTrue++;
            }
        }
        if ($counterTrue == count($categories)) {
            return true;
        } else {
            return false;
        }
    }

    public function constituteProduct($product, $colours, $categories)
    {
        $product = $this->rebuildProduct($product);
        $colours = $this->rebuildColours($colours);
        $categories = $this->rebuildCategories($categories);
        return array_merge($product, ['colours' => $colours], ['categories' => $categories]);
    }

    public function rebuildProduct($data)
    {
        $images = unserialize(array_pop($data));
        return array_merge($data, ['images' => $images]);
    }

    public function rebuildColours($data)
    {
        $colours = [];
        foreach ($data as $item) {
            $colours = array_merge($colours, [$item['colour'] => $item['quantity']]);
        }
        return $colours;
    }

    public function rebuildCategories($data)
    {
        $categories = [];
        foreach ($data as $item) {
            $categories = array_merge($categories, [$item['category']]);
        }
        return $categories;
    }

    public function checkInput($data)
    {
        for ($i = 0; $i <= count($data); $i++) {
            if (!empty($_POST["$i"])) {
                return true;
            }
        }
    }

    public function resultInputColours($colours)
    {
        $i = 0;
        $quantity = [];
        foreach ($colours as $colour) {
            $quantity = array_merge($quantity, [$colour => $_POST["$i"]]);
            $i = $i + 1;
        }
        return array_filter($quantity);
    }

    public function resultInputCategories($data)
    {
        $categories = [];
        for ($i = 0; $i < count($data); $i++) {
            if (isset($_POST["$i"])) {
                array_push($categories, $data[$i]);
            }
        }
        return $categories;
    }

    static function uploadImages($data)
    {
        $images = [];
        for ($i = 0; $i < count($data['name']); $i++) {
            $extension = pathinfo($data['name'][$i], PATHINFO_EXTENSION);
            $tmp_name = $data['tmp_name'][$i];
            $fileName = uniqid() . $i . '.' . $extension;
            move_uploaded_file($tmp_name, '../web/images/products/' . $fileName);
            array_push($images, $fileName);
        }
        return $images;
    }

}
