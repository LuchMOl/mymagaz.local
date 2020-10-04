<?php

namespace app\views\product;

require_once("../views/layouts/header.php");
//var_dump($curentUser);
?>

<main class="ps-main">
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
            <div class="ps-cart-listing">
                <table class="table ps-cart__table">
                    <thead>
                        <tr>
                            <th>All Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$cart->isEmpty()) : ?>
                            <?php foreach ($cart->getProducts() as $product) : ?>
                                <tr>
                                    <td>
                                        <a class="ps-product__preview" href="product-detail.html">
                                            <img class="mr-15 cart-image" src="<?= $product->getImgPath(); ?>" alt="">
                                            <?= $product->name; ?>
                                            (color: <?= $product->colors[$product->getColorId()]; ?> )
                                            size: <?= $product->sizes[$product->getSizeId()]; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <span><?= $product->price ?></span> UAH
                                    </td>
                                    <td>
                                        <div class="form-group--number" data-cart-row-id="<?= $product->getCartRowId(); ?>">
                                            <button class="minus"><span>-</span></button>
                                            <input class="form-control" type="text" value="<?= $product->getQuantity(); ?>">
                                            <button class="plus"><span>+</span></button>
                                        </div>
                                    </td>
                                    <td>
                                        <span><?= $product->getCartPrice(); ?></span> UAH
                                    </td>
                                    <td>
                                        <a href="/cart/delete/?cartRowId=<?= $product->getCartRowId(); ?>">
                                            <div class="ps-remove">
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td>
                                    <h3>Корзина пуста.</h3>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="ps-cart__actions">
                    <div class="ps-cart__promotion">
                        <div class="form-group">
                            <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                                <input class="form-control" type="text" placeholder="Promo Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="ps-cart__total">
                        <h3>Total Price: <span> <?= $cart->getProductsPrice(); ?> UAH</span></h3><a class="ps-btn" href="checkout.html">Process to checkout<i class="ps-icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../views/layouts/footer.php'; ?>