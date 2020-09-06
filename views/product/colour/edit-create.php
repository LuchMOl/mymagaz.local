<?php

namespace app\views\product\colour;

require_once '../views/layouts/admin/header.php';

$colourDir = '/images/products/';
$colourImage = isset($colourImage) ? $colourImage : $colourDir . 'no_photo.jpg';
$curentColour = isset($curentColour['colour']) ? $curentColour : '';

?>

<div class='container'><br><hr>

    <h2><?= $title; ?></h2><br>

    <form method = 'post' action = '' >
        <h4>Название цвета</h4>
        <input name = 'colourName' type = 'text' value = "<?= $curentColour['colour']; ?>">
        <hr>

        <h4>Загрузить фото цвета</h4>
        <img style = "width: 200px" src = "<?= $colourImage; ?>">
        <br><br>

        <input type="file" name="colourImage" accept="image/jpeg,image/png,image/bmp">
        <hr>

        <input name = 'submitColourForm' type = 'submit' value = 'Подтвердить'>
    </form>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>