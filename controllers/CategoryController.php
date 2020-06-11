<?php

class CategoryController
{

    private $categoryService;

    public function categoryService()
    {
        if ($this->categoryService === NULL) {
            $this->categoryService = new categoryService();
        }
        return $this->categoryService;
    }

    public function actionIndex()
    {
        require_once '../views/product/category/index.php';
    }

    public function actionCreateNewCategory()
    {
        $mesage = '';
        $categories = $this->categoryService()->GetCategories();
        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                if ($_POST['parent'] === 'none') {
                    if ($this->categoryService()->insertNewCategory($_POST['newCategory'])) {
                        header('Location: /category/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
                } else {
                    $IdParentCategory = $this->categoryService()->GetIdParentCategory($_POST['parent']);
                    if ($this->categoryService()->insertNewCategoryWithParent($_POST['newCategory'], $IdParentCategory)) {
                        header('Location: /category/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
                }
            } else {
                $mesage = 'Не указана новая категория.';
            }
        }
        require_once '../views/product/category/create.php';
    }

    public function actionShowAllCategories()
    {
        $mesage = '';
        $categories = $this->categoryService()->GetCategories();
        //var_dump($categories);
        if (empty($categories)) {
            $mesage = 'В базе нет ни одной категории.';
        }
        require_once '../views/product/category/showAll.php';
    }

    /*
      public function actionEditCategory()
      {
      $mesage = '';
      if (isset($_GET['categoryname'])) {
      $item = str_replace('_', ' ', $_GET['categoryname']);
      //var_dump($item);
      if ($this->categoryService()->GetIdIssetItem('categories', 'name', $item)) {
      if (isset($_POST['eidtCategory'])) {
      if ($_POST['newCategoryName'] !== $item) {
      if ($this->categoryService()->editCategory($item, $_POST['newCategoryName'])) {
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
     */

    public function actionDeleteCategory()
    {
        $mesage = '';

        $categories = $this->categoryService()->GetColumnTable('name', 'categories');
        if (isset($_GET['categoryname'])) {
            $item = str_replace('_', ' ', $_GET['categoryname']);
            if ($id = $this->categoryService()->GetIdIssetItem('categories', 'name', $item)) {
                if (!$parent = $this->categoryService()->ParentsIsset($id)) {
                    $this->categoryService()->deleteCategory($item);
                    header('Location: /category/showAllCategories/');
                } else {
                    $mesage = "Нельзя удалить $item, так как он родительский для категории $parent";
                }
            }
        }
        require_once '../views/product/category/showAll.php';
    }

}
