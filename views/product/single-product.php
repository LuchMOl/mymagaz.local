<?php

namespace app\views\product\category;

require_once("../views/layouts/header.php");
$imageDir = '/images/products/';
?>

<main class="ps-main">
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">

                        <div class="ps-product__image">
                            <div class="item"><img class="zoom" src="<?= $product->getImgPath(); ?>" alt="" data-zoom-image="images/shoe-detail/1.jpg"></div>
                        </div>
                    </div>
                    <div class="ps-product__thumbnail--mobile">
                        <div class="ps-product__main-img"><img src="" alt=""></div>
                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
                    </div>
                    <div class="ps-product__info">

                        <h1><?= $product->name; ?></h1>
                        <p class="ps-product__category">
                            <?php foreach ($product->categories as $category) : ?>
                                <a href="/catalog/<?= $category->id; ?>"><?= $category->name; ?></a> |
                            <?php endforeach; ?>
                        <h3 class="ps-product__price"><?= $product->price; ?> uah</h3>

                        <div class="ps-product__block ps-product__style">
                            <h4>CHOOSE YOUR STYLE</h4>
                            <ul>
                                <?php foreach ($product->colours as $colour) : ?>
                                    <li><a class="colorElement" href="#" data-color-id="<?= $colour['id']; ?>"><img src="/images/products/colours/<?= $colour['colour'] ?>.jpg" alt=""></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="ps-product__block ps-product__size">
                            <h4>CHOOSE SIZE</h4>
                            <select id="sizeSelect" class="ps-select selectpicker">
                                <option value="0">Select Size</option>
                                <?php foreach ($product->sizes as $size) : ?>
                                    <option value="<?= $size['id'] ?>"><?= $size['size'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-group">
                                <input id="quantityInput" class="form-control" type="number" value="1">
                            </div>
                        </div>
                        <div class="ps-product__shopping"><a class="ps-btn mb-10 addToCartBtn" href="">Add to cart<i class="ps-icon-next"></i></a>
                            <form id="productCartForm" method="POST" action="/cart/add/">
                                <input type="hidden" name="productId" value="<?=$product->id?>">
                                <input type="hidden" name="colorId" value="">
                                <input type="hidden" name="sizeId" value="">
                                <input type="hidden" name="quantity" value="">
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>



    <?php require_once '../views/layouts/footer.php'; ?>