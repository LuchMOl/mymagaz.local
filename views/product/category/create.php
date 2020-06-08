<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><h1><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/product/category/'>< Управление категориями</a> |
                Создать новую категорию</h1><hr>

            <form method = 'post' action = ''>

                <input name = 'newCategory' type = 'text'></input><br><br>
                <input name = 'insertNewCategory' type = 'submit' value = 'Добавить новую категорию'><br><br>

            </form>
            <?=$mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>