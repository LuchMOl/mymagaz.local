<?php

class ProductController
{

    private $productService;
    private $categoryService;

    public function productService()
    {
        if ($this->productService === NULL) {
            $this->productService = new productService();
        }
        return $this->productService;
    }

    public function categoryService()
    {
        if ($this->categoryService === NULL) {
            $this->categoryService = new CategoryService();
        }
        return $this->categoryService;
    }

    public function actionIndex()
    {
        require_once '../views/product/index.php';
    }

    public function actionCatalog()
    {
        $mesage = '';
        $categoryId = explode('/', $_SERVER['REQUEST_URI'])[3];
        if ($categoryId != '') {
            $category = $this->productService()->getThisCategory($categoryId);
            $title = is_object($category) ? $category->name : 'Такой категории не существует';
            $products = $this->productService()->getProductsThisCategory($categoryId);
        } else {
            $title = 'Все товары';
            $products = $this->productService()->getProducts();
        }
        require_once '../views/product/catalog.php';
    }

    public function actionCreateNew()
    {
        $mesage = '';
        $title = 'Добавить товар';
        $categories = $this->categoryService()->getCategories();

        if (isset($_POST['submitForm'])) {
            if (!empty($_POST['newName'])) {
                $write = $this->productService()->insertNew($_POST['newName'], $_POST['categories']);
                $write ? header('Location: /product/') : $mesage = 'Не записало в базу.';
            } else {
                $mesage = 'Не введено название товара.';
            }
        }


        require_once '../views/product/edit-create.php';
    }

    public function actionEdit()
    {
        $mesage = '';
        $title = 'Редактировать товар';
        $products = $this->productService()->getProducts();
        $currentProduct = $this->productService()->getCurrentProduct($products, $_GET['editId']);
        $categories = $this->categoryService()->getCategories();

        if (isset($_POST['submitForm'])) {
            if (!empty($_POST['newName'])) {
                if ($currentProduct->isChanged($_POST['newName'], $_POST['categories'])) {
                    $edit = $this->productService()->edit($currentProduct->id, $_POST['newName'], $_POST['categories']);
                    $edit ? header("Location: /product/catalog/") : $mesage = 'Не записало в базу';
                } else {
                    $mesage = 'Нечего менять';
                }
            } else {
                $mesage = 'Не заполнено обязательное поле';
            }
        }
        require_once '../views/product/edit-create.php';
    }

}
