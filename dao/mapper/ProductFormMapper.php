<?php

namespace app\dao\mapper;

use app\models\ProductForm;

class ProductFormMapper
{

    public function map($data)
    {
        $productForm = new ProductForm();

        $productForm->setName($data);
        $productForm->setCategories($data);
        $productForm->setImageName($data);
        $productForm->setcolors($data);
        $productForm->setSizes($data);
        $productForm->setPrice($data);
        $productForm->setCurrencyId($data['currencyId']);

        return $productForm;
    }

}
