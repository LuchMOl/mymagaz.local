<?php require_once '/../../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                Редактировать категорию</p><hr>

            <?php ?>
            <?php if (isset($_GET['editId'])) : ?>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->id === $_GET['editId']) : ?>
                        <h3>Редактирование категории:</h3><br>
                        <h4>
                            <?php
                            $tree = categoryService::getHierarchyTree($categories, $_GET['editId']);
                            foreach ($tree as $branch) {
                                echo $branch . ' -> ';
                            }
                            ?></h4>
                        <h3><?= $category->name ?></h3><br>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <form method = 'post' action = ''>
                <?php if (!isset($_GET['parentid'])) : ?>
                    <select name = 'parent'>
                        <option value = 'none'>none</option>
                        <option value = '0'>Root</option>
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category->isRoot()) : ?>
                                <option value = '<?= $category->id; ?>'><?= $category->name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <input name = 'submitToChildren' type = 'submit' value = 'To Children'>
                    <!--добавить кнопку возврата/сброса в корень, при выборе в селект нового родителя-->
                <?php else : ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($category->id == $_GET['parentid']) : ?>
                            <?= $category->name; ?> ->
                            <select name = 'parent'>
                                <option value = 'none'>none</option>
                                
                                <?php if ($category->hasChildren()) : ?>
                                    <?php foreach ($category->children as $child) : ?>
                                        <option value = '<?= $child->id; ?>'><?= $child->name; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    Нет детей
                                <?php endif; ?>
                            </select>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <input name = 'submitToChildren' type = 'submit' value = 'To Children'>
                    <input name = 'submitToRoot' type = 'submit' value = 'To Root'>
                <?php endif; ?>
                <br><br>

                <?php if (isset($_GET['editId'])) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php if ($category->id === $_GET['editId']) : ?>
                            <p>Название новой категории</p>
                            <input name = 'newCategoryName' type = 'text' value = '<?= $category->name; ?>'></input><br><br>
                            <?php if ($category->topMenu) : ?>
                                <input name = 'checkTopMenu' type="checkbox" checked> Применить для главного меню</input><br><br>
                            <?php else : ?>
                                <input name = 'checkTopMenu' type="checkbox"> Применить для главного меню</input><br><br>
                            <?php endif; ?>
                            <input name = 'submitEdit' type = 'submit' value = 'Применить изменение в категории'><br><br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </form>
            <?php echo $mesage; ?>
            <hr>
        </div>
    </div>
</section>

<?php require_once '/../../layouts/footer.php'; ?>