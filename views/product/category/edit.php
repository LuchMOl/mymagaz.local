<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/product/category/'>< Управление категориями</a> |
                Редактировать категорию</p><hr>

            <form method = 'post' action = ''>

                <input name = 'newCategoryName' type = 'text' value = '<?= $item?>'></input><br><br>
                <input name = 'eidtCategory' type = 'submit' value = 'Применить изменение в категории'><br><br>

            </form>
            <?=$mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>