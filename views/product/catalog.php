<?php
require_once ($catalog == 'front' ? '../views/layouts/header.php' : '../views/layouts/admin/header.php');
$imageDir = '/images/products/';
?>

<div class='container'>
    <div class='container'>
        <br>
        <hr>
        <h2><?= $title; ?></h2>
        <br>

        <ul>
            <?php if (isset($products) AND is_array($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <?php if ($catalog == 'back') : ?>

                        <div class="col-md-3 col-sm-4">
                            <a href="/product/edit/?editId=<?= $product->id; ?>">
                                <div class="single-product">
                                    <div class="product-block">

                                        <img style="height: 200px; width: 240px" src="<?= !empty($product->imageName[0]) ? $imageDir . $product->imageName[0] : $imageDir . 'no_photo.jpg'; ?>" alt="" class="thumbnail">
                                        <div class="product-description text-center">
                                            <p class="title"><?= $product->name; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php elseif ($catalog == 'front') : ?>
                        <div class="col-md-3 col-sm-4">
                            <div class="single-new-arrival">
                                <div class="single-new-arrival-bg">
                                    <img src="<?= $imageDir . $product->imageName[0]; ?>" alt="new-arrivals /images">
                                    <div class="single-new-arrival-bg-overlay"></div>
                                    <div class="sale bg-2">
                                        <p>sale</p>
                                    </div>
                                    <div class="new-arrival-cart">
                                        <p>
                                            <span class="lnr lnr-cart"></span>
                                            <a href="#">add <span>to </span> cart</a>
                                        </p>
                                        <p class="arrival-review pull-right">
                                            <span class="lnr lnr-heart"></span>
                                            <span class="lnr lnr-frame-expand"></span>
                                        </p>
                                    </div>
                                </div>
                                <h4><a href="/catalog/<?= $categoryId; ?>/?id=<?= $product->id; ?>"><?= $product->name; ?></a></h4>
                                <p class="arrival-product-price"></p>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>

            </ul>
        <?php elseif (!empty($categories)) : ?>
            <?php foreach ($categories as $category): ?>
                <ul>
                    <?php if ($category->activity) : ?>
                        <li><a href='/catalog/<?= $category->id; ?>/'><?= $category->name; ?></a></li>
                    <?php endif; ?>
                </ul>
            <?php endforeach; ?>
        <?php else : ?>
            В базе нет ни одного товара.
        <?php endif; ?>

        <br><br>
        <?= $mesage ?>
        <hr>
    </div>
</div>

<?php require_once ($catalog == 'front' ? '../views/layouts/footer.php' : '../views/layouts/admin/footer.php'); ?>