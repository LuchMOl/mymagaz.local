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
        if (isset($_POST['toChildren'])) {
            if ($_POST['parent'] !== 'none') {
                header("Location: /category/createNewCategory/?id=" . $_POST['parent']);
            }
        }
        if (isset($_POST['submitToRoot'])) {
            header('Location: /category/createNewCategory/');
        }

        if (isset($_POST['insertNewCategory'])) {
            if (!empty($_POST['newCategory'])) {
                $get = isset($_GET['id']) ? $_GET['id'] : '';
                $parentId = $this->categoryService()->defineParentId($_POST['parent'], $get);
                $topMenu = isset($_POST['checkTopMenu']) ? 1 : 0;
                $write = $this->categoryService()->insertNewCategory($_POST['newCategory'], $parentId, $topMenu);
                $parentId = 0 ? $id = 'all' : $id = $parentId;
                $write ? header("Location: /category/showAllCategories/?id=" . $id) : $mesage = 'Запись в базу НЕ прошла.';
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
        $newTopMenu = [];
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['applySelectedCategoriesForTopMenu'])) {
            for ($i = 1; $i <= 5; $i++) {
                if ($_POST[$i] !== 'none') {
                    $newTopMenu [] = $_POST[$i];
                }
            }
            $this->categoryService()->changeCategoriesTopMenu($newTopMenu);
            header('Location: /');
        }
        require_once '../views/product/category/choiceCategoriesForTopMenu.php';
    }

    public function actionEditCategory()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['submitToChildren'])) {
            if ($_POST['parent'] !== 'none' AND $_POST['parent'] !== '0') {
                header('Location: /category/editcategory/?editId=' . $_GET['editId'] . '&parentid=' . $_POST['parent']);
            }
        }
        if (isset($_POST['submitToRoot'])) {
            header('Location: /category/editcategory/?editId=' . $_GET['editId']);
        }

        if (isset($_POST['submitEdit'])) {
            foreach ($categories as $category) {
                if ($category->id == $_GET['editId']) {
                    break;
                }
            }
            isset($_POST['checkTopMenu']) ? $checkTopMenu = '1' : $checkTopMenu = '0';

            if (isset($_GET['parentid']) AND $_POST['parent'] == 'none') {
                $parentId = $_GET['parentid'];
            } elseif ($_POST['parent'] != 'none') {
                $parentId = $_POST['parent'];
            } else {
                $parentId = $category->parentId;
            }

            if ($category->isChanged($_POST['newCategoryName'], $checkTopMenu, $parentId)) {
                $edit = $this->categoryService()->editCategory($category->id, $_POST['newCategoryName'], $checkTopMenu, $parentId);
                $category->parentId == '0' ? $parent = 'all' : $parent = $category->parentId ;
                $edit ? header("Location: /category/showAllCategories/?id=" . $parent) : $mesage = 'Не записало в базу';
            } else {
                $mesage = 'Нечего менять.';
            }
        }
        require_once '../views/product/category/edit.php';
    }

    /* public function actionDeleteCategory()
      {

      } */
}
