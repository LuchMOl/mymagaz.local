<?php
require_once '../views/layouts/admin/header.php';
$imageDir = '/images/products/';
?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
    <hr>

    <h2><?= $title; ?></h2><br>

    <form method = 'post' action = '' enctype="multipart/form-data">

        <p>Название товара</p>

        <input name = 'productName' type = 'text' value = "<?= isset($_GET['editId']) ? htmlspecialchars($currentProduct->name) : ''; ?>">
        <br><br>

        <p>Выбрать категорию</p>
        <select name = 'categories[]' size ='15' multiple>
            <option value = '0' <?= $title == 'Добавить товар' ? 'selected' : '';?>>- нет -</option>
            <?= $this->productService()->selectCategory($currentProduct->category); ?>
        </select>
        <br><br>

        <?php if ($title == 'Редактировать товар') : ?>
            <img style = "width: 200px" src = "<?= !empty($currentProduct->imageName[0]) ? $imageDir . $currentProduct->imageName[0] : $imageDir . 'no_photo.jpg'; ?>">
            <br><br>
        <?php endif; ?>
        <input type="file" name="productImage">
        <br><br>

        <input name = 'submitProductForm' type = submit value = 'Подтвердить'>

    </form><br>

    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '../views/layouts/admin/footer.php'; ?>