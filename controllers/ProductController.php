<?php

namespace app\controllers;

use app\services\ProductService;
use app\services\CategoryService;
use app\services\colorService;
use app\services\SizeService;
use app\models\Product;
use app\models\ProductForm;
use app\dao\mapper\ProductFormMapper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController
{

    private $productService;
    private $categoryService;
    private $colorService;
    private $sizeService;
    private $productFormMapper;

    public function productService()
    {
        if ($this->productService === NULL) {
            $this->productService = new ProductService();
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

    public function colorService()
    {
        if ($this->colorService === NULL) {
            $this->colorService = new colorService();
        }
        return $this->colorService;
    }

    public function sizeService()
    {
        if ($this->sizeService === NULL) {
            $this->sizeService = new SizeService();
        }
        return $this->sizeService;
    }

    public function ProductFormMapper()
    {
        if ($this->productFormMapper === NULL) {
            $this->productFormMapper = new ProductFormMapper();
        }
        return $this->productFormMapper;
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
            $products = $this->productService()->getAllProducts();
        }
        require_once '../views/product/catalog.php';
    }

    public function actionCreateNew()
    {
        $mesage = '';
        $mode = 'create';

        $allcolors = $this->colorService()->getAllcolors();
        $allSizes = $this->sizeService()->getAllSizes();

        if (isset($_POST['submitProductForm'])) {
            if (!empty($_POST['productName'])) {

                $productImageName = !empty($_FILES) ? $this->productService()->writeFile($_FILES['productImage']) : '';

                $_POST ['imageName'] = $productImageName;
                $product = $this->ProductFormMapper()->map($_POST);

                $writeProduct = $this->productService()->writeProduct($product);

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
        $mode = 'edit';

        if (isset($_GET['editId'])) {

            $product = $this->productService()->getProductById($_GET['editId']);
            $allcolors = $this->colorService()->getAllcolors();
            $allSizes = $this->sizeService()->getAllSizes();

            if (isset($_POST['submitProductForm'])) {
                if (!empty($_POST['productName'])) {

                    if (empty($product->imageName)) {
                        $_POST ['imageName'] = !empty($_FILES) ? $this->productService()->writeFile($_FILES['productImage']) : '';
                    } else {
                        !empty($_FILES) ? $this->productService()->uploadProductImage($_FILES['productImage'], $product->imageName) : '';
                        $_POST ['imageName'] = $product->imageName;
                    }

                    $editedProduct = $this->ProductFormMapper()->map($_POST);
                    $editedProduct->setId($product->id);

                    $editProduct = $this->productService()->editProduct($editedProduct);

                    $editProduct ? header('Location: /product/catalog/') : $mesage = 'Не записало в базу.';
                } else {
                    $mesage = 'Не заполнено обязательное поле';
                }
            }
            require_once '../views/product/edit-create.php';
        } else {
            header("Location: /product/catalog/");
        }
    }

    public function actionTestxls()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save(dirname(__DIR__) . '/hello world.xlsx');
        die('done');
    }

}
