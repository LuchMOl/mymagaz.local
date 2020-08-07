<?php require_once '../views/layouts/admin/header.php'; ?>
<?php $categoryService = new CategoryService(); ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        <a href = '/category/showAll/'>< Список всех категорий</a> | <hr>

    <h2><?= $title; ?></h2><br>
    <?php if (isset($_GET['editId'])) : ?>
        <?php $tree = $categoryService->getHierarchyTree($categories, $_GET['editId'], ''); ?>
        <?php //var_dump($tree); exit();?>
        <?php foreach ($tree as $branch) : ?>
            <a href ='/category/edit/?editId=<?= $branch->id ?>' target="_blank"><?= $branch->name; ?></a> ->
        <?php endforeach; ?>
        <?= $curentCategory->name ?><br><br>
    <?php else : ?>
        <?php $curentCategory->activity = '1'; ?>
    <?php endif; ?>
    <form method = 'post' action = ''>
        <p>Выбрать родительскую категорию</p>

        <select name = 'parent'>
            <option value = '0'>- нет -</option>
            <?= $categoryService->selectAll(); ?>
        </select>
        <br><br>

        <input name = 'newName' type = 'text' value = "<?= $curentCategory->name ?>"> Название категории<br><br>

        <input name = 'rank' type = 'number' value = "<?= $curentCategory->rank ?>" min="0" max="250"> Ранг<br><br>
        <label><input name = 'checkTopMenu' type="checkbox" <?= $curentCategory->topMenu ? 'checked' : ''; ?>> Применить для главного меню</label><br><br>
        <label><input name = 'checkActivity' type="checkbox" <?= $curentCategory->activity ? 'checked' : ''; ?>> Активность</label><br><br>
        <input name = 'submitForm' type = 'submit' value = 'Подтвердить'><br><br>

    </form>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>