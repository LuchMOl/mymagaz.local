<?php require_once '/../layouts/header.php'; ?>

<div class='container'><div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
        <hr>

        <h2><?= $title; ?></h2><br>

        <ul>
            <?php if (!empty($products)) : ?>
                <?php //var_dump($products); ?>
                <?php foreach ($products as $product): ?>
                    <ul>
                        <li><a href='/product/edit/?editId=<?= $product->id; ?>'><?= $product->name; ?></a></li>
                    </ul>
                <?php endforeach; ?>
            <?php else : ?>
                В базе нет ни одного товара.
            <?php endif; ?>

        </ul>
        <br><br>
        <ul><li><a href = '/product/createNew/'>Добавить новый товар</a><br><br></li></ul>
        <?= $mesage ?>
        <hr>
    </div>

    <?php require_once '/../layouts/footer.php'; ?>