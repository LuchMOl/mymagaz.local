<?php

namespace app\views\product\colour;

use app\services\CategoryService;

require_once '../views/layouts/admin/header.php';

$dir = 'images/products/colours/';

$maxQuantityColourItemInRow = 4;
$count = 0;
?>

<div class='container'><br><hr>

    <?php foreach ($allColours as $colour) : ?>
        <?= is_integer($count / $maxQuantityColourItemInRow) ? '<br>' : ''; ?>
        <a href="/colour/edit/?editId=<?= $colour['id'] ?>">
            <div class="colour">
                <?= $colour['colour'] ?>
                <?php
                if (file_exists($dir . $colour['colour'] . '.jpg')) {
                    $colourFile = $dir . $colour['colour'] . '.jpg';
                } else {
                    $colourFile = $dir . 'no_photo.jpg';
                }
                ?>
                <div class="square" style="background: url(/<?= $colourFile; ?>)">
                </div>
            </div>
        </a>
        <?php $count++; ?>
    <?php endforeach; ?>

    <br><br><ul><li><a href = '/colour/createNew/'>Создать новый цвет</a><br><br></li></ul>
    <?= $mesage ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>