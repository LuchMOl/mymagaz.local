<?php

namespace app\views\product\color;

use app\services\CategoryService;

require_once '../views/layouts/admin/header.php';

$dir = 'images/products/colors/';

$maxQuantitycolorItemInRow = 4;
$count = 0;
?>

<div class='container'><br><hr>

    <?php foreach ($allcolors as $color) : ?>
        <?= is_integer($count / $maxQuantitycolorItemInRow) ? '<br>' : ''; ?>
        <a href="/color/edit/?editId=<?= $color['id'] ?>">
            <div class="color">
                <?= $color['color'] ?>
                <?php
                if (file_exists($dir . $color['color'] . '.jpg')) {
                    $colorFile = $dir . $color['color'] . '.jpg';
                } else {
                    $colorFile = $dir . 'no_photo.jpg';
                }
                ?>
                <div class="square" style="background: url(/<?= $colorFile; ?>)">
                </div>
            </div>
        </a>
        <?php $count++; ?>
    <?php endforeach; ?>

    <br><br><ul><li><a href = '/color/createNew/'>Создать новый цвет</a><br><br></li></ul>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>