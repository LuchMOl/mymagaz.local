<?php require_once '/../../layouts/header.php'; ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        <a href = '/category/createNewCategory/'>Создать новую категорию</a></p><hr>
    <p>Родительская категория</p>
    <form method = 'post' action = ''>
        <?php if (!isset($_GET['id'])) : ?>
            <select name = 'parent'>
                <option value = 'none'>none</option>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->isRoot()) : ?>
                        <option value = '<?= $category->id; ?>'><?= $category->name; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <input name = 'toChildren' type = 'submit' value = 'To Children'>
        <?php else : ?>
            <?php foreach ($categories as $category) : ?>
                <?php if ($category->getId() == $_GET['id']) : ?>
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

            <input name = 'toChildren' type = 'submit' value = 'To Children'>
            <input name = 'submitToRoot' type = 'submit' value = 'To Root'>
        <?php endif; ?>
        <br><br>
        <p>Название новой категории</p>
        <input name = 'newCategory' type = 'text'></input><br><br>

        <input name = 'checkTopMenu' type="checkbox"> Применить для главного меню</input><br><br>
        <input name = 'insertNewCategory' type = 'submit' value = 'Добавить новую категорию'><br><br>
    </form>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>