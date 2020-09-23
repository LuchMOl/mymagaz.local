<?php

namespace app\views\product\color;

require_once '../views/layouts/admin/header.php';

$colorDir = '/images/products/';
$colorImage = isset($colorImage) ? $colorImage : $colorDir . 'no_photo.jpg';
$curentcolor = isset($curentcolor['color']) ? $curentcolor : '';

?>

<div class='container'><br><hr>

    <h2><?= $title; ?></h2><br>

    <form method = 'post' action = '' >
        <h4>Название цвета</h4>
        <input name = 'colorName' type = 'text' value = "<?= $curentcolor['color']; ?>">
        <hr>

        <h4>Загрузить фото цвета</h4>
        <img style = "width: 200px" src = "<?= $colorImage; ?>">
        <br><br>

        <input type="file" name="colorImage" accept="image/jpeg,image/png,image/bmp">
        <hr>

        <input name = 'submitcolorForm' type = 'submit' value = 'Подтвердить'>
    </form>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>