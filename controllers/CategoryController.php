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

    public function actionCreateNew()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        $curentCategory = $this->categoryService()->getEmptyCategory();
        $title = 'Создать категорию';

        if (isset($_POST['submitForm'])) {
            if (!empty($_POST['newName'])) {
                $parentId = $_POST['parent'] != 'root' ? $_POST['parent'] : 0;
                $rank = !empty($_POST['rank']) ? $_POST['rank'] : 0;
                $topMenu = isset($_POST['checkTopMenu']) ? 1 : 0;
                $activity = isset($_POST['checkActivity']) ? 1 : 0;
                $write = $this->categoryService()->insertNew($_POST['newName'], $parentId, $rank, $topMenu, $activity);
                $write ? header("Location: /category/showAll/") : $mesage = 'Запись в базу НЕ прошла.';
            } else {
                $mesage = 'Не заполнено обязательное поле.';
            }
        }
        require_once '../views/product/category/edit-create.php';
    }

    public function actionShowAll()
    {
        $mesage = '';
        $action = 'ShowAll';
        $categories = $this->categoryService()->getRoots();
        if (isset($_POST['aply'])) {
            $this->categoryService()->eraseTopMenu();
        }
        require_once '../views/product/category/showAll.php';
    }

    public function actionEdit()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        $curentCategory = $this->categoryService()->getCategoryById($categories, $_GET['editId']);
        $title = "Редактировать категорию -$curentCategory->name-";

        if (isset($_POST['submitForm'])) {
            if (!empty($_POST['newName'])) {
                $parentId = $this->categoryService()->defineParentId($_POST['parent'], $curentCategory->parentId);
                $rank = !empty($_POST['rank']) ? $_POST['rank'] : 0;
                $checkTopMenu = isset($_POST['checkTopMenu']) ? 1 : 0;
                $checkActivity = isset($_POST['checkActivity']) ? 1 : 0;
                if ($curentCategory->isChanged($_POST['newName'], $parentId, $rank, $checkTopMenu, $checkActivity)) {
                    $edit = $this->categoryService()->edit($curentCategory->id, $_POST['newName'], $parentId, $rank, $checkTopMenu, $checkActivity);
                    $edit ? header("Location: /category/showAll/") : $mesage = 'Не записало в базу';
                } else {
                    $mesage = 'Нечего менять.';
                }
            } else {
                $mesage = 'Не заполнено обязательное поле.';
            }
        }
        require_once '../views/product/category/edit-create.php';
    }

    /* public function actionDeleteCategory()
      {

      } */
}
