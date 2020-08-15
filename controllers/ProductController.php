<?php

namespace app\controllers;

use app\services\productService;
use app\services\CategoryService;

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
        $catalog = 'back';
        $categoryId = explode('/', $_SERVER['REQUEST_URI'])[3];
        if ($categoryId != '') {
            $category = $this->productService()->getCategoryById($categoryId);
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

        if (isset($_POST['submitProductForm'])) {
            if (!empty($_POST['productName'])) {

                if (file_exists($_FILES['productImage']['tmp_name'])) {
                    $productImageName = $this->productService()->generateImageName($_FILES['productImage']);
                    $isUpload = $this->productService()->uploadProductImage($_FILES['productImage'], $productImageName);
                    $mesage = $isUpload ? '' : 'Файл не перемещен.';
                } else {
                    $productImageName = 'no_photo.jpg';
                }

                $category = !isset($_POST['categories']) ? ['0'] : $_POST['categories'];
                $writeProduct = $this->productService()->writeProduct($_POST['productName'], $category, $productImageName);

                $writeProduct ? header('Location: /product/catalog/') : $mesage = 'Не записало в базу.';
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

        if (isset($_GET['editId'])) {

            $currentProduct = $this->productService()->getProductById($_GET['editId']);

            if (isset($_POST['submitProductForm'])) {
                if (!empty($_POST['productName'])) {
                    $isChangedImage = $currentProduct->isChangedImage($_FILES['productImage']);
                    if ($isChangedImage) {
                        if ($currentProduct->imageName[0] == 'no_photo.jpg') {
                            $productImageName = $this->productService()->generateImageName($_FILES['productImage']);
                        } else {
                            $productImageName = $currentProduct->imageName[0];
                        }
                        $this->productService()->uploadProductImage($_FILES['productImage'], $productImageName);
                    } else {
                        $productImageName = $currentProduct->imageName[0];
                    }

                    $categories = !isset($_POST['categories']) ? ['0'] : $_POST['categories'];

                    $editedProduct = ['id' => $_GET['editId'],
                        'name' => $_POST['productName'],
                        'categories' => $categories,
                        'imageName' => $productImageName];

                    $editedProduct = $this->productService()->mapEditedProduct($editedProduct);

                    if ($currentProduct->isChanged($editedProduct)) {
                        $editProduct = $this->productService()->editProduct($currentProduct, $editedProduct);
                        $editProduct ? header('Location: /product/catalog/') : $mesage = 'Не записало в базу.';
                    } elseif ($isChangedImage) {
                        header('Location: /product/catalog/');
                    } else {
                        $mesage = 'Нечего менять';
                    }
                } else {
                    $mesage = 'Не заполнено обязательное поле';
                }
            }
            require_once '../views/product/edit-create.php';
        } else {
            header("Location: /product/catalog/");
        }
    }

}
