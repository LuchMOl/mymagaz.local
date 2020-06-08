<?php require_once '/../../layouts/header.php'; ?>

<div class='container'><br><h1><a href = '/product/'>< Работа с товарами</a> |
        <a href = '/product/category/'>< Управление категориями</a> |
        Создать новую категорию</h1><hr>

    <form method = 'post' action = ''>
        <select name = 'parent'>
            <option value = 'none'>none</option>
            <?php
                foreach ($categories as $category){
                    echo "<option value = '$category'>$category</option>";
                }
            ?>
        </select><br><br>
            <input name = 'newCategory' type = 'text'></input><br><br>
        <input name = 'insertNewCategory' type = 'submit' value = 'Добавить новую категорию'><br><br>

    </form>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '/../../layouts/footer.php'; ?>