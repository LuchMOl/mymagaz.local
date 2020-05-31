<?php

class ProductService
{

    public function GetProduct($name, $value)
    {
        $productDao = new ProductDao();

        $product = $productDao->GetProduct($name, $value);
        $colours = $productDao->GetColoursQuantity($product['id']);
        $categories = $productDao->GetCategories($product['id']);
        return $this->constituteProduct($product, $colours, $categories);
    }

    public function GetNameAndImagesOfProduct()
    {
        $productDao = new ProductDao();
        $products = $productDao->GetNameAndImagesOfProduct();
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
        $productDao = new ProductDao();
        return $productDao->GetColumnTable($column, $table);
    }

    public function insertNewColour($newColour)
    {
        $productDao = new ProductDao();
        if ($productDao->insertNewColour($newColour)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertNewCategory($newCategory)
    {
        $productDao = new ProductDao();
        if ($productDao->insertNewCategory($newCategory)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertNewProduct($newProduct)
    {
        $productDao = new ProductDao();
        $productId = $productDao->insertNewProduct($newProduct);
        if (is_numeric($productId)) {
            return $productId;
        } else {
            return false;
        }
    }

    public function insertColourQuantityOfNewProduct($productId, $colours)
    {
        $productDao = new ProductDao();
        $counterTrue = 0;
        foreach ($colours as $colour => $quantity) {
            if ($productDao->insertColourQuantityOfNewProduct($productId, $colour, $quantity)) {
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
        $productDao = new ProductDao();
        $counterTrue = 0;
        foreach ($categories as $category) {
            if ($productDao->insertCategoryOfNewProduct($productId, $category)) {
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
