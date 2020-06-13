<?php require_once '/../../layouts/header.php'; ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        Выбрать категории для меню</p><hr>
    <form method = 'post' action = ''>
        <?php for ($i = 0; $i < 5; $i++) : ?>
            <select name = '<?= $i ?>'>
                <option value = 'none'>none</option>
                <?php foreach ($categories as $parent => $category) : ?>
                    <option><?= $parent ?></option>
                    <?php foreach ($category as $child => $SeniorChildren) : ?>
                        <option><?= $parent ?> -> <?= $child ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select><br><br>
        <?php endfor; ?>

        <p></p>
        <input name = 'applySelectedCategoriesForTopMenu' type = 'submit' value = 'Применить'><br><br>
    </form>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>