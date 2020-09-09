<?php

namespace app\controllers;

use app\services\CategoryService;

class CatalogController extends ProductController
{

    public function actionIndex()
    {
        $mesage = '';
        $catalog = 'front';
        $title = 'Все категории';
        $categoryService = new CategoryService();
        $categoriesOfExistingProducts = $categoryService->getCategoriesOfExistingProducts();
        //var_dump($categories);
        require_once '../views/product/catalog.php';
    }

    public function actionViewProducts($categoryId)
    {
        if (!isset($_GET['id'])) {
            $mesage = '';
            $catalog = 'front';
            $category = $this->productService()->getCategoryById($categoryId);
            $title = is_object($category) ? $category->name : 'Такой категории не существует';
            $products = !empty($category) ? $this->productService()->getProductsThisCategory($categoryId) : '';
            require_once '../views/product/catalog.php';
        } else {
            $product = $this->productService()->getProductById($_GET['id']);
            //var_dump($product);
            require_once '../views/product/single-product.php';
        }
    }

}
