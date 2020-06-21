<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                <a href = '/category/showAllCategories/?id=all'>Список всех категорий</a></p><hr>
            <table>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($_GET['id'] == 'all') : ?>
                        <?php if ($category->isRoot()) : ?>
                            <tr><td><h3><a href ='/category/showAllCategories/?id=<?= $category->id; ?>'>
                                            <?= $category->name; ?></a></h3></td>
                                <td><a href ='/category/editcategory/?editId=<?= $category->id; ?>'> редактировать</a></td>
                                <?php if ($category->topMenu) : ?>
                                    <td><a href ='/category/showAllCategories/?id=topMenu'> В меню </a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>

                    <?php elseif ($_GET['id'] == 'topMenu') : ?>
                        <?php if ($category->isTopMenu()) : ?>
                            <tr><td><h3><a href ='/category/showAllCategories/?id=<?= $category->id; ?>'>
                                            <?= $category->name; ?></a></h3></td>
                                <td><a href ='/category/editcategory/?editId=<?= $category->id; ?>'> редактировать</a></td>
                                <?php if ($category->topMenu) : ?>
                                    <td><a href ='/category/showAllCategories/?id=topMenu'> В меню </a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>

                    <?php elseif ($category->id == $_GET['id']) : ?>
                        <?php if (!$category->isRoot()) : ?>
                            <h2><a href ='/category/showAllCategories/?id=<?= $category->parentId; ?>'>
                                    <?= categoryService::getParent($categories, $category->parentId)->name; ?>
                                </a></h2><br>
                        <?php else : ?>
                            <h2><a href ='/category/showAllCategories/?id=all'>Root</a></h2><br>
                        <?php endif; ?>
                        <h3><a href ='/category/showAllCategories/?id=<?= $category->id; ?>'>
                                <?= $category->name; ?>
                            </a></h3><br><br>
                        <?php if ($category->hasChildren()) : ?>
                            <?php foreach ($category->children as $children) : ?>
                                <tr><td><p><a href ='/category/showAllCategories/?id=<?= $children->id; ?>'>
                                                <b><?= $children->name; ?></b></a></p></td>
                                    <td><a href ='/category/editcategory/?editId=<?= $children->id; ?>'> редактировать</a></td>
                                    <?php if ($children->topMenu) : ?>
                                        <td><a href ='/category/showAllCategories/?id=topMenu'> В меню </a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            Нет детей.
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </table>
            <br><br><ul><li><a href = '/category/createNewCategory/'>Создать новую категорию</a><br><br></li></ul>
            <?= $mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>