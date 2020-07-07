<?php require_once '/../layouts/header.php'; ?>
<?php $productService = new ProductService(); ?>

<div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
    <hr>

    <h2><?= $title; ?></h2><br>

    <form method = 'post' action = '' enctype="multipart/form-data">

        <p>Название товара</p>

        <?php if (isset($_GET['editId'])) : ?>
            <?php foreach ($products as $product) : ?>
                <?php if ($product->id == $_GET['editId']) : ?>
                    <input name = 'newName' type = 'text' value = "<?= htmlspecialchars($product->name); ?>"></input>
                    <?php break; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <input name = 'newName' type = 'text' value = ""></input>
        <?php endif; ?>

        <br><br>
        <p>Выбрать категорию</p>
        <select name = 'categories[]' size ='10' multiple>
            <option value = '0'>- нет -</option>
            <?= $productService->selectCategory($categories, $product->category); ?>
        </select>
        <br><br>

        <input name = 'submitForm' type = submit value = 'Подтвердить'>
    </form><br>
    <?php echo $mesage; ?>
    <hr>
</div>

<?php require_once '/../layouts/footer.php'; ?>