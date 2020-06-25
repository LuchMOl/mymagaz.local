<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                <a href = '/category/showAll/'>Список всех категорий</a></p><hr>

            <?php ?>
            <form method = 'post' action = ''>
                <table>

                    <?php if (!isset($_GET['showId'])): ?>
                        <?php $rootCategories = CategoryService::getSortRank($categories, 'isRoot'); ?>
                        <?php foreach ($rootCategories as $category) : ?>
                            <tr>
                                <td><h4><a href ='/category/showAll/?showId=<?= $category->id; ?>'><?= $category->name; ?></a></h4></td>

                                <?php if ($action == 'Ranging') : ?>
                                    <td><input name="<?= $category->id ?>" type="number" min="0" max="250" value="<?= $category->rank ?>"></td>
                                    <?php $category->activity ? $checked = 'checked' : $checked = ''; ?>
                                    <td><input name = 'checkActivity<?= $category->id ?>' type="checkbox" <?= $checked ?>></input></td>
                                <?php endif; ?>

                                <?php if ($action == 'ShowAll') : ?>
                                    <td><a href ='/category/edit/?editId=<?= $category->id; ?>'> редактировать </a></td>
                                    <?php if ($category->topMenu) : ?>
                                        <td><a href ='/category/showAll/?showId=topMenu'> В меню </a></td>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>

                    <?php elseif ($_GET['showId'] == 'topMenu') : ?>
                        <?php $topMenuCategories = CategoryService::getSortRank($categories, 'isTopMenu'); ?>
                        <?php if (isset($topMenuCategories)) : ?>
                            <?php foreach ($topMenuCategories as $category) : ?>
                                <tr>
                                    <td><h4><a href ='/category/showAll/?showId=<?= $category->id; ?>'><?= $category->name; ?></a></h4></td>

                                    <?php if ($action == 'Ranging') : ?>
                                        <td><input name="<?= $category->id ?>" type="number" min="0" max="250" value="<?= $category->rank ?>"></td>
                                        <?php $category->activity ? $checked = 'checked' : $checked = ''; ?>
                                        <td><input name = 'checkActivity<?= $category->id ?>' type="checkbox" <?= $checked ?>></input></td>
                                    <?php endif; ?>

                                    <?php if ($action == 'ShowAll') : ?>
                                        <td><a href ='/category/edit/?editId=<?= $category->id; ?>'> редактировать </a></td>
                                        <?php if ($category->topMenu) : ?>
                                            <td><a href ='/category/showAll/?showId=topMenu'> В меню </a></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <a href = '/category/showAll/'>В меню нет ни одной категории.</a></p><hr>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php foreach ($categories as $category) : ?>
                        <?php if (isset($_GET['showId']) AND $category->id == $_GET['showId']): ?>
                            <a href ='/category/showAll/'>Root</a> ->
                            <?php $tree = categoryService::getHierarchyTree($categories, $_GET['showId']); ?>
                            <?php foreach ($tree as $id => $branch) : ?>
                                <a href ='/category/showAll/?showId=<?= $id; ?>'><?= $branch; ?></a> ->
                            <?php endforeach; ?>
                            <a href ='/category/showAll/?showId=<?= $category->id; ?>'><?= $category->name; ?></a><br><br>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach ($categories as $category) : ?>
                        <?php if (isset($_GET['showId']) AND $category->id == $_GET['showId']): ?>
                            <?php if ($category->hasChildren()) : ?>
                                <?php $childrenCategories = CategoryService::getSortRank($category->children, ''); ?>
                                <?php foreach ($childrenCategories as $children) : ?>
                                    <tr>
                                        <td><h4><a href ='/category/showAll/?showId=<?= $children->id; ?>'><?= $children->name; ?></a></h4></td>
                                        <?php if ($action == 'Ranging') : ?>
                                            <td><input name="<?= $children->id ?>" type="number" min="0" max="250" value="<?= $children->rank ?>"></td>
                                            <?php $children->activity ? $checked = 'checked' : $checked = ''; ?>
                                            <td><input name = 'checkActivity<?= $children->id ?>' type="checkbox" <?= $checked ?>></input></td>
                                        <?php endif; ?>

                                        <?php if ($action == 'ShowAll') : ?>
                                            <td><a href ='/category/edit/?editId=<?= $children->id; ?>'> редактировать </a></td>
                                            <?php if ($children->topMenu) : ?>
                                                <td><a href ='/category/showAll/?showId=topMenu'> В меню </a></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                Нет детей.
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </table><br>

                <?php if ($action == 'ShowAll') : ?>
                    <input name = 'submitToRanging' type = 'submit' value = 'To Ranging'>
                <?php endif; ?>
                <?php if ($action == 'Ranging') : ?>
                    <input name = 'submitToShow' type = 'submit' value = 'Show'>
                    <input name = 'submitApply' type = 'submit' value = 'Apply?'>
                <?php endif; ?>

                <?php if ($action == 'ShowAll') : ?>
                    <?php if (isset($_GET['showId']) AND $_GET['showId'] == 'topMenu') : ?>
                        <input name = 'submitEraseTopMenu' type = 'submit' value = 'Erase Top Menu'>
                        <?php if (isset($_POST['submitEraseTopMenu'])) : ?>
                            <input name = 'submitApply' type = 'submit' value = 'Apply?'>
                        <?php endif; ?>
                        <?php if (isset($_POST['submitApply'])) : ?>
                            <input name = 'submitAreYouSure' type = 'submit' value = 'Are You Sure?'>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </form>

            <br><ul><li><a href = '/category/createNew/'>Создать новую категорию</a><br><br></li></ul>
            <?= $mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>