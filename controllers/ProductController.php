<?php

class ProductController
{

    private $productService;

    public function productService()
    {
        if ($this->productService === NULL) {
            $this->productService = new productService();
        }
        return $this->productService;
    }

    public function actionIndex()
    {
        require_once '../views/product/index.php';
    }

}