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
        if (isset($_POST['submitToChildren'])) {
            if ($_POST['parent'] !== 'none') {
                header("Location: /category/createNew/?parentid=" . $_POST['parent']);
            }
        }
        if (isset($_POST['submitToRoot'])) {
            header('Location: /category/createNew/');
        }

        if (isset($_POST['submitInsertNew'])) {
            if (!empty($_POST['newName'])) {
                $get = isset($_GET['parentid']) ? $_GET['parentid'] : '';
                $parentId = $this->categoryService()->defineParentId($_POST['parent'], $get);
                $topMenu = isset($_POST['checkTopMenu']) ? 1 : 0;
                $write = $this->categoryService()->insertNew($_POST['newName'], $parentId, $topMenu);
                $parentId == 0 ? $id = 'all' : $id = $parentId;
                $write ? header("Location: /category/showAll/?showId=" . $id) : $mesage = 'Запись в базу НЕ прошла.';
            } else {
                $mesage = 'Не указана новая категория.';
            }
        }
        require_once '../views/product/category/create.php';
    }

    public function actionRanging()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        $action = 'Ranging';

        if (isset($_POST['submitToShow'])) {
            if (isset($_GET['showId'])) {
                $third = '?showId=' . $_GET['showId'];
            } else {
                $third = '';
            }
            header("Location: /category/showAll/$third");
        }

        if (isset($_POST['submitApply'])) {
            if (isset($_GET['showId']) AND $_GET['showId'] != 'topMenu') {
                foreach ($categories as $category) {
                    if ($category->id == $_GET['showId']) {
                        foreach ($category->children as $children) {
                            isset($_POST["checkActivity$children->id"]) ? $checkActivity = '1' : $checkActivity = '0';
                            if ($children->isChangedRank($_POST[$children->id], $checkActivity)) {
                                $edit = $this->categoryService()->editRank($children->id, $_POST[$children->id], $checkActivity);
                                $category->parentId == '0' ? $show = "?showId=$category->id" : $show = "?showId=$category->id";
                                $edit ? header("Location: /category/showAll/$show") : $mesage = 'Не записало в базу';
                            } else {
                                $mesage = 'Нечего менять.';
                            }
                        }
                    }
                }
            } elseif (isset($_GET['showId']) AND $_GET['showId'] == 'topMenu') {
                foreach ($categories as $category) {
                    if ($category->isTopMenu()) {

                        isset($_POST["checkActivity$category->id"]) ? $checkActivity = '1' : $checkActivity = '0';
                        if ($category->isChangedRank($_POST[$category->id], $checkActivity)) {
                            $edit = $this->categoryService()->editRank($category->id, $_POST[$category->id], $checkActivity);
                            $edit ? header("Location: /category/showAll/?showId=topMenu") : $mesage = 'Не записало в базу';
                        } else {
                            $mesage = 'Нечего менять.';
                        }
                    }
                }
            } else {
                foreach ($categories as $category) {
                    if ($category->isRoot()) {
                        isset($_POST["checkActivity$category->id"]) ? $checkActivity = '1' : $checkActivity = '0';
                        if ($category->isChangedRank($_POST[$category->id], $checkActivity)) {
                            $edit = $this->categoryService()->editRank($category->id, $_POST[$category->id], $checkActivity);
                            $edit ? header("Location: /category/showAll/") : $mesage = 'Не записало в базу';
                        } else {
                            $mesage = 'Нечего менять.';
                        }
                    }
                }
            }
        }

        require_once '../views/product/category/showAll.php';
    }

    public function actionShowAll()
    {
        $mesage = '';
        $action = 'ShowAll';
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['submitAreYouSure'])) {
            $this->categoryService()->eraseTopMenu() ? header("Location: /category/showAll/") : $mesage = 'Не очистило.';
        }

        if (isset($_POST['submitToRanging'])) {
            if (isset($_GET['showId'])) {
                $third = '?showId=' . $_GET['showId'];
            } else {
                $third = '';
            }
            header("Location: /category/ranging/$third");
        }

        require_once '../views/product/category/showAll.php';
    }

    public function actionEdit()
    {
        $mesage = '';
        $categories = $this->categoryService()->getCategories();
        if (isset($_POST['submitToChildren'])) {
            if ($_POST['parent'] !== 'none' AND $_POST['parent'] !== '0') {
                header('Location: /category/edit/?editId=' . $_GET['editId'] . '&parentid=' . $_POST['parent']);
            }
        }
        if (isset($_POST['submitToRoot'])) {
            header('Location: /category/edit/?editId=' . $_GET['editId']);
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

            if ($category->isChanged($_POST['newName'], $checkTopMenu, $parentId)) {
                $edit = $this->categoryService()->edit($category->id, $_POST['newName'], $checkTopMenu, $parentId);
                $category->parentId == '0' ? $show = '' : $show = "?showId=$category->parentId";
                $edit ? header("Location: /category/showAll/$show") : $mesage = 'Не записало в базу';
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
