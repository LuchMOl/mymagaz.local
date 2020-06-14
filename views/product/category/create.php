<?php require_once '/../../layouts/header.php'; ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/category/'>< Управление категориями</a> |
        Создать новую категорию</p><hr>
    <p>Родительская категория</p>
    <form method = 'post' action = ''>
        <select name = 'parent'>
            <option value = 'none'>none</option>
            <?php foreach ($categories as $row) : ?>
                <option><?= $this->category()->getName($row); ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <p>Название новой категории</p>
        <input name = 'newCategory' type = 'text'></input><br><br>
        <input name = 'insertNewCategory' type = 'submit' value = 'Добавить новую категорию'><br><br>
    </form>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>