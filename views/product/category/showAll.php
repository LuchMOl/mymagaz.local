<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                Список всех категорий</p><hr>

            <?php foreach ($categories as $item) : ?>
                <p><h3><?= $this->category()->getName($item) ?></h3><br>
            <?php endforeach; ?>

            <br><ul><li><a href = '/category/createNewCategory/'>Создать новую категорию</a><br><br></li></ul>
            <?= $mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>