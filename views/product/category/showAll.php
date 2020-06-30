<?php require_once '/../../layouts/header.php'; ?>
<?php $categoryService = new CategoryService(); ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        <a href = '/category/showAll/'>Список всех категорий</a></p><hr>

    <?php if (isset($_GET['show']) == 'topMenu') : ?>
        <h4>Категории топ меню.</h4><br>
        <?php $topMenu = $categoryService->getTopMenu(); ?>
        <?php if (!empty($topMenu)) : ?>
            <?php foreach ($topMenu as $cat) : ?>
                <a href ='/category/edit/?editId=<?= $cat->id ?>'>
                    <?= $cat->name ?> (<?= $cat->id ?>) -</a>
                Ранг: <?= $cat->rank ?> -
                <?= $cat->activity ? 'Активна' : 'Не активна'; ?>
                <br>
            <?php endforeach; ?>
            <br>
            <form method = 'post' action = ''>
                <input name = 'eraseTopMenu' type = 'submit' value = 'eraseTopMenu'><br><br>
                <?= isset($_POST['eraseTopMenu']) ? "<input name = 'aply' type = 'submit' value = 'aply'><br><br>" : ''; ?>
            </form>
        <?php else : ?>
            Пусто.<br>
        <?php endif; ?>

    <?php else : ?>
        <h4>Все категории.</h4><br>
        <?php $categoryService->renderShowAll($categories); ?>
    <?php endif; ?>

    <br><ul><li><a href = '/category/createNew/'>Создать новую категорию</a><br><br></li></ul>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>