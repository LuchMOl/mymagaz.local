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
        $categories = $this->productService()->GetColumnTable('name', 'categories');
        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                if ($_POST['parent'] === 'none') {
                    if ($this->productService()->insertNewCategory($_POST['newCategory'])) {
                        header('Location: /product/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
                } else {
                    $parentId = $this->productService()->GetIdIssetItem('categories', 'name', $_POST['parent']);
                    if ($this->productService()->insertNewCategoryWithParent($_POST['newCategory'], $parentId)) {
                        header('Location: /product/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
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
        $mesage = '';
        $categories = $this->productService()->GetColumnTable('name', 'categories');
        $categoriesWithParent = $this->productService()->getCategoriesWithParent($categories);
        if (empty($categories)) {
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
            if ($this->productService()->GetIdIssetItem('categories', 'name', $item)) {
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

    public function actionDeleteCategory()
    {
        $mesage = '';
        $categories = $this->productService()->GetColumnTable('name', 'categories');
        if (isset($_GET['categoryname'])) {
            $item = str_replace('_', ' ', $_GET['categoryname']);
            if ($id = $this->productService()->GetIdIssetItem('categories', 'name', $item)) {
                if (!$parent = $this->productService()->ParentsIsset($id)) {
                    $this->productService()->deleteCategory($item);
                    header('Location: /product/showAllCategories/');
                } else {
                    $mesage = "Нельзя удалить $item, так как он родительский для категории $parent";
                }
            }
        }
        require_once '../views/product/category/showAll.php';
    }

}
