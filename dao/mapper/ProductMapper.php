<?php

namespace app\dao\mapper;

use app\models\Product;

class ProductMapper
{

    public function map($data)
    {
        $product = new Product();

        $product->setId($data['id']);
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setCurrencyId($data['currencyId']);

        return $product;
    }

}
