<?php

class ProductMapper
{

    public function map($data)
    {
        $product = new Product();

        $product->setId($data['id']);
        $product->setName($data['name']);
        
        return $product;
    }

}
