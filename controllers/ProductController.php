<?php

class ProductController
{

    public function actionIndex()
    {
        $_SESSION['product'] = '';
        require_once '../views/product/index.php';
    }

    public function actionAddProduct()
    {
        if (isset($_POST['next'])) {
            if (!empty($_POST["name"])) {
                if (!empty($_POST["brand"])) {
                    if (!empty($_POST["size"])) {
                        if (!empty($_POST["description"])) {
                            if (!empty(array_filter($_FILES['images']['name']))) {
                                $images = ProductService::uploadImages($_FILES['images']);
                                $product = ['name' => $_POST["name"],
                                    'brand' => $_POST["brand"],
                                    'size' => $_POST["size"],
                                    'description' => $_POST["description"],
                                    'images' => serialize($images)];
                                //var_dump($product);
                                $_SESSION['product'] = $product;
                                header('Location: ../selectColour/');
                            } else {
                                echo 'Не выбраны изображения.';
                            }
                        } else {
                            echo 'Не заполнено описание.';
                        }
                    } else {
                        echo 'Не заполнено размер.';
                    }
                } else {
                    echo 'Не заполнено бренд.';
                }
            } else {
                echo 'Не заполнено назвение.';
            }
        }
        require_once '../views/product/addProduct.php';
    }

    public function actionSelectColour()
    {
        $productService = new ProductService;
        $colours = $productService->GetColumnTable('colour', 'colours');
        if (isset($_POST['next'])) {
            if ($productService->checkInput($colours)) {
                $colour = ['colours' => $productService->resultInputColours($colours)];
                $_SESSION['product'] = array_merge($_SESSION['product'], $colour);
                header('Location: ../selectCategory/');
            } else {
                echo 'не выбран ни один цвет.';
            }
        }
        if (isset($_POST['insertNewColour'])) {
            if (!empty($_POST['newColour'])) {
                if ($productService->insertNewColour($_POST['newColour'])) {
                    header("Location:" . $_SERVER['REQUEST_URI']);
                }
            } else {
                echo 'не введен новий цвет.';
            }
        }
        require_once '../views/product/selectColour.php';
    }

    public function actionSelectCategory()
    {
        $productService = new ProductService;
        $categories = $productService->GetColumnTable('category', 'categories');
        if (isset($_POST['insertNewProduct'])) {
            if ($productService->checkInput($categories)) {
                $category = ['categories' => $productService->resultInputCategories($categories)];
                $_SESSION['product'] = array_merge($_SESSION['product'], $category);
                $productId = $productService->insertNewProduct($_SESSION['product']);
                if (is_numeric($productId)) {
                    if ($productService->insertColourQuantityOfNewProduct($productId, $_SESSION['product']['colours'])) {
                        if ($productService->insertCategoryOfNewProduct($productId, $_SESSION['product']['categories'])) {

                            header('Location: /product/showAllProducts/');
                        }
                    }
                }
            } else {
                echo 'Не выбрано ни одной категории.';
            }
        }
        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                if ($productService->insertNewCategory($_POST['newCategory'])) {
                    header("Location:" . $_SERVER['REQUEST_URI']);
                }
            } else {
                echo 'не введена новая категория.';
            }
        }

        require_once '../views/product/selectCategory.php';
    }

    public function actionShowProduct()
    {
        $productService = new ProductService;
        $product = $productService->GetProduct('name', $_GET['name']);
        require_once '../views/product/showProduct.php';
    }

    public function actionShowAllProducts()
    {
        $productService = new ProductService;
        //$products = $productService->GetColumnTable('name', 'products');
        $products = $productService->GetNameAndImagesOfProduct();
        require_once '../views/product/allProducts.php';
    }

}
