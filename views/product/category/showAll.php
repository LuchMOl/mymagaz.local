<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                Список всех категорий</p><hr>
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $superCategory => $category) : ?>
                    <p><h3><?= $superCategory ?></h3><br>
                    <?php foreach ($category as $parent => $SeniorChildren) : ?>
                        <b><?= $parent ?></b><br>
                        <?php foreach ($SeniorChildren as $Child) : ?>
                            <i><?= $Child ?></i><br>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
            <br><ul><li><a href = '/category/createNewCategory/'>Создать новую категорию</a><br><br></li></ul>
            <?= $mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>