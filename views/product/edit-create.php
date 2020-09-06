<?php

namespace app\views\product;

use app\services\ColourService;
use app\services\SizeService;
use app\models\Product;

require_once '../views/layouts/admin/header.php';

$modeEdit = $mode == 'edit';
$modeCreate = $mode == 'create';
$product = isset($product) ? $product : new Product();
$colourDir = '/images/products/colours/';
$price = $modeEdit ? $product->price : '';

$maxQuantityColourItemInRow = 6;
$count = 0;
$title = $modeCreate ? 'Добавить товар' : 'Редактировать товар';
?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
    <hr>

    <h2><?= $title; ?></h2><br>

    <form method = 'post' action = '' enctype="multipart/form-data">

        <h4>Название товара</h4>
        <input name = 'productName' type = 'text' value = "<?= $product->name; ?>">
        <hr>

        <h4>Выбрать категорию</h4>
        <select name = 'categories[]' size ='15' multiple>
            <option value = '0' <?= $mode == 'create' ? 'selected' : ''; ?>>- нет -</option>
            <?= $this->productService()->selectCategories($product->categories); ?>
        </select>
        <hr>

        <h4>Загрузить фото товара</h4>
        <img style = "width: 200px" src = "<?= $product->getImgPath() ?>">
        <br><br>
        <input type="file" name="productImage" accept="image/jpeg,image/png,image/bmp">
        <hr>

        <h4>Выбрать цвет</h4>
        <?php foreach ($allColours as $colour): ?>
        <?php $checked = ''; ?>
            <?php foreach ($product->colours as $productColour): ?>
                <?php if ($colour['id'] == $productColour['id']): ?>
                    <?php $checked = 'checked'; ?>
                    <?php break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="colour">
                <label>
                    <input name = 'colourIds[]' type="checkbox" value="<?= $colour['id']; ?>" <?= $checked; ?>>
                    <?= $colour['colour']; ?>
                    <div class="square" style="background: url(<?= $colourDir . $colour['colour']; ?>.jpg)">
                    </div>
                </label>
            </div>
            <?php $count++; ?>
            <?= is_integer($count / $maxQuantityColourItemInRow) ? '<br>' : ''; ?>
        <?php endforeach; ?>
        <hr>

        <h4>Выбрать размер</h4>
        <?php foreach ($allSizes as $size): ?>
        <?php $checked = ''; ?>
            <?php foreach ($product->sizes as $productSize): ?>
                <?php if ($size['id'] == $productSize['id']): ?>
                    <?php $checked = 'checked'; ?>
                    <?php break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="size">
                <label>
                    <input name = 'sizeIds[]' type="checkbox" value="<?= $size['id']; ?>" <?= $checked; ?>>
                    <?= $size['size']; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <hr>

        <h4>Указать цену</h4>
        <input name = 'price' type = 'number' value = "<?= $price; ?>" min="0"> Цена<br><br>
        <hr>
        <input name = 'submitProductForm' type = submit value = 'Подтвердить'>

    </form><br>

    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>