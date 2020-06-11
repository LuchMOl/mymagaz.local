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

    public function GetColumnTable($column, $table)
    {
        return $this->productDao()->GetColumnTable($column, $table);
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
