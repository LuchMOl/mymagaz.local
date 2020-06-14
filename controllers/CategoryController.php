<?php

class CategoryController
{

    private $categoryService;
    private $category;

    public function categoryService()
    {
        if ($this->categoryService === NULL) {
            $this->categoryService = new CategoryService();
        }
        return $this->categoryService;
    }

    public function category()
    {
        if ($this->category === NULL) {
            $this->category = new Category();
        }
        return $this->category;
    }

    public function actionIndex()
    {
        require_once '../views/product/category/index.php';
    }

    public function actionCreateNewCategory()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                if ($_POST['parent'] === 'none') {
                    if ($this->categoryService()->insertNewCategory($_POST['newCategory'])) {
                        header('Location: /category/showAllCategories/');
                    } else {
                        $mesage = 'Запись в базу НЕ прошла.';
                    }
                } else {
                    $idParentCategory = $this->categoryService()->getIdParentCategory($_POST['parent']);
                    if ($this->categoryService()->insertNewCategoryWithParent($_POST['newCategory'], $idParentCategory)) {
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
        $categories = $this->categoryService()->getCategories();

        require_once '../views/product/category/showAll.php';
    }

    public function actionChoiceCategoriesForTopMenu()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['applySelectedCategoriesForTopMenu'])) {
            $idTopCategories = [];
            for ($i = 0; $i < 5; $i++) {
                $id = $this->categoryService()->getIdCategory($_POST[$i]);
                $idTopCategories = array_merge($idTopCategories, [$id]);
            }
            $this->categoryService()->ApplyChoiceCategoriesForMenu($idTopCategories);
            header('Location: /');
        }
        require_once '../views/product/category/choiceCategoriesForTopMenu.php';
    }

    /*
      public function actionEditCategory()
      {

      }
     */

    /* public function actionDeleteCategory()
      {

      } */
}
