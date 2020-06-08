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
        $_SESSION['product'] = '';
        require_once '../views/product/index.php';
    }

    public function actionCategory()
    {
        require_once '../views/product/category/index.php';
    }

    public function actionCreateNewCategory()
    {
        $mesage = '';
        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                if ($this->productService()->checkIssetItem('categories', 'category', $_POST['newCategory'])) {
                    if ($this->productService()->insertNewCategory($_POST['newCategory'])) {
                        header('Location: /product/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
                    $mesage = 'Категория "' . $_POST['newCategory'] . '" уже существует.';
                }
            } else {
                $mesage = 'Не указана новая категория.';
            }
        }
        //echo $mesage;
        require_once '../views/product/category/create.php';
    }

    public function actionShowAllCategories()
    {
        if (empty($categories = $this->productService()->GetColumnTable('category', 'categories'))) {
            $mesage = 'В базе нет ни одной категории.';
        }
        require_once '../views/product/category/showAll.php';
    }

    public function actionEditCategory()
    {
        $mesage = '';
        if (isset($_GET['categoryname'])) {
            $item = str_replace('_', ' ', $_GET['categoryname']);
            //var_dump($item);
            if ($this->productService()->checkIssetItem('categories', 'category', $item)) {
                if (isset($_POST['eidtCategory'])) {
                    if ($_POST['newCategoryName'] !== $item) {
                        if ($this->productService()->editCategory($item, $_POST['newCategoryName'])) {
                            header('Location: /product/showAllCategories/');
                        } else {
                            $mesage = 'Не удалось отредактировать имя категории.';
                        }
                    } else {
                        $mesage = 'Имя категории не редактировалось.';
                    }
                }
            } else {
                $mesage = "База не содержит категории $item.";
            }
            require_once '../views/product/category/edit.php';
        }
    }

    public function actionDellCategory()
    {
        $categories = $this->productService()->GetColumnTable('category', 'categories');
        if (isset($_GET['categoryname'])) {
            $item = str_replace('_', ' ', $_GET['categoryname']);
            if ($this->productService()->checkIssetItem('categories', 'category', $item)) {
                $this->productService()->deleteCategory($item);
                header('Location: /product/showAllCategories/');
            } else {
                $mesage = 'Не удалилось.';
            }
        }

        require_once '../views/product/category/showAll.php';
    }

    public function actionAddProduct()
    {
        $productService = new ProductService;
        $colours = $productService->GetColumnTable('colour', 'colours');
        $categories = $productService->GetColumnTable('category', 'categories');
        $warning = '';
        if (isset($_POST['write'])) {
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
                                $warning = 'Не выбраны изображения.';
                            }
                        } else {
                            $warning = 'Не заполнено описание.';
                        }
                    } else {
                        $warning = 'Не заполнено размер.';
                    }
                } else {
                    $warning = 'Не заполнено бренд.';
                }
            } else {
                $warning = 'Не заполнено назвение.';
            }
        }
        echo $warning;
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
