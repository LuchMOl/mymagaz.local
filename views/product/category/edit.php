<?php require_once '/../../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                <a href = '/category/showAll/'>< Список всех категорий</a> |
                Редактирование категории</p><hr>

            <?php ?>
            <?php if (isset($_GET['editId'])) : ?>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->id === $_GET['editId']) : ?>
                        <h3>Редактирование категории:</h3><br>

                        <a href ='/category/showAll/'>Root</a> ->
                        <?php $tree = categoryService::getHierarchyTree($categories, $_GET['editId']); ?>
                        <?php foreach ($tree as $id => $branch) : ?>
                            <a href ='/category/showAll/?showId=<?= $id; ?>'><?= $branch; ?></a> ->
                        <?php endforeach; ?>
                        <a href ='/category/showAll/?showId=<?= $category->id; ?>'>
                            <?= $category->name; ?>
                        </a>
                        <br><br>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <p>Изменить родительскую категорию на:</p>
            <form method = 'post' action = ''>
                <?php if (!isset($_GET['parentid'])) : ?>
                    <select name = 'parent'>
                        <option value = 'none'>Не менять</option>
                        <option value = '0'>Root</option>
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category->isRoot()) : ?>
                                <option value = '<?= $category->id; ?>'><?= $category->name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <input name = 'submitToChildren' type = 'submit' value = 'To Children'>
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
                            <p>Новое название категории</p>
                            <input name = 'newName' type = 'text' value = '<?= $category->name; ?>'></input><br><br>
                            <?php $category->topMenu ? $checked = 'checked' : $checked = ''; ?>
                            <input name = 'checkTopMenu' type="checkbox" <?= $checked ?>> Применить для главного меню</input><br><br>

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