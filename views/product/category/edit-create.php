<?php require_once '/../../layouts/header.php'; ?>
<?php $categoryService = new CategoryService(); ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        <a href = '/category/showAll/'>< Список всех категорий</a> | <hr>

    <h2><?= $title; ?></h2><br>
    <?php if (isset($_GET['editId'])) : ?>
        Root ->
        <?php $tree = $categoryService->getHierarchyTree($categories, $_GET['editId'], ''); ?>
        <?php foreach ($tree as $branch) : ?>
            <?= $branch; ?> ->
        <?php endforeach; ?>
        <?= $curentCategory->name ?><br><br>
    <?php endif; ?>
    <form method = 'post' action = ''>
        <p>Выбрать родительскую категорию</p>

        <select name = 'parent'>
            <?= isset($_GET['editId']) ? "<option value = 'doNotChange'>- не менять -</option>" : ''; ?>
            <option value = 'root'>- root -</option>
            <?= $categoryService->selectAll($categories); ?>
        </select>
        <br><br>

        <p></p>
        <input name = 'newName' type = 'text' value = "<?= $curentCategory->name ?>"> Название категории</input><br><br>

        <p></p>
        <input name = 'rank' type = 'text' value = "<?= $curentCategory->rank ?>"> Ранг</input><br><br>
        <?php $checked = $curentCategory->topMenu ? 'checked' : ''; ?>
        <input name = 'checkTopMenu' type="checkbox" <?= $checked ?>> Применить для главного меню</input><br><br>
        <?php $checked = $curentCategory->activity ? 'checked' : ''; ?>
        <input name = 'checkActivity' type="checkbox" <?= $checked ?>> Активность</input><br><br>
        <input name = 'submitForm' type = 'submit' value = 'Подтвердить'><br><br>

    </form>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>