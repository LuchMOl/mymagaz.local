<?php

namespace app\views\product;

use app\services\colorService;
use app\services\SizeService;
use app\models\Product;

require_once '../views/layouts/admin/header.php';

$modeEdit = $mode == 'edit';
$modeCreate = $mode == 'create';
$product = isset($product) ? $product : new Product();
$colorDir = '/images/products/colors/';
$price = $modeEdit ? $product->price : '';

$maxQuantitycolorItemInRow = 6;
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
        <?php foreach ($allcolors as $color): ?>
        <?php $checked = ''; ?>
            <?php foreach ($product->colors as $key => $productcolor): ?>
                <?php if ($color['id'] == $key): ?>
                    <?php $checked = 'checked'; ?>
                    <?php break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="color">
                <label>
                    <input name = 'colorIds[]' type="checkbox" value="<?= $color['id']; ?>" <?= $checked; ?>>
                    <?= $color['color']; ?>
                    <div class="square" style="background: url(<?= $colorDir . $color['color']; ?>.jpg)">
                    </div>
                </label>
            </div>
            <?php $count++; ?>
            <?= is_integer($count / $maxQuantitycolorItemInRow) ? '<br>' : ''; ?>
        <?php endforeach; ?>
        <hr>

        <h4>Выбрать размер</h4>
        <?php foreach ($allSizes as $size): ?>
        <?php $checked = ''; ?>
            <?php foreach ($product->sizes as $key => $productSize): ?>
                <?php if ($size['id'] == $key): ?>
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