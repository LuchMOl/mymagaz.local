<?php

namespace app\views\layouts;

use app\services\CurrencyService;

require_once 'head.php';

$currencyService = new CurrencyService();
$allCurrency = $currencyService->getAllCurrency();
?>
<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                    <p><?= $curentUser->getGreeting(); ?></p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                    <div class="header__actions"><a href="/user/">Login & Regiser</a>
                        <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $curentUser->getCurrency()->getCcy(); ?><i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($allCurrency as $currency) : ?>
                                    <?php if ($currency->getActive()) : ?>
                                        <li>
                                            <a href="/currency/byDefaultCurrencyForUser/?currencyId=<?= $currency->getId(); ?>&uri=<?= $_SERVER['REQUEST_URI']; ?>">
                                                <img src="/images/flag/<?= $currency->getCcy(); ?>.svg" alt=""> <?= $currency->getCcy(); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="btn-group ps-dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Language<i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Japanese</a></li>
                                <li><a href="#">Chinese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo"><a class="ps-logo" href="/"><img src="/images/logo.png" alt=""></a></div>
            </div>
            <div class="navigation__column center">
                <?php
                include_once 'topmenu.php';
                ?>
            </div>
            <div class="navigation__column right">
                <form class="ps-search--header" action="do_action" method="post">
                    <input class="form-control" type="text" placeholder="Search Product…">
                    <button><i class="ps-icon-search"></i></button>
                </form>
                <div class="ps-cart">
                    <a class="ps-cart__toggle" href="/cart/">
                        <?php if (!$cart->isEmpty()) : ?>
                            <span><i><?= count($cart->getProducts()); ?></i></span>
                        <?php endif; ?>
                        <i class="ps-icon-shopping-cart"></i>
                    </a>
                    <div class="ps-cart__listing">
                        <div class="ps-cart__content">
                            <?php if (!$cart->isEmpty()) : ?>
                                <?php foreach ($cart->getProducts() as $product) : ?>
                                    <div class="ps-cart-item">
                                        <a class="ps-cart-item__close" href="/cart/delete/?cartRowId=<?= $product->getCartRowId(); ?>"></a>
                                        <div class="ps-cart-item__thumbnail">
                                            <a href="product-detail.html"></a>
                                            <img src="<?= $product->getImgPath(); ?>" alt="">
                                        </div>
                                        <div class="ps-cart-item__content" data-cart-row-id="<?= $product->getCartRowId(); ?>" ><a class="ps-cart-item__title" href="product-detail.html"><?= $product->name; ?></a>
                                            <p><span>Quantity:<i><?= $product->getQuantity(); ?></i></span>
                                                <span>Total:<i><?= $product->getCartPrice(); ?></span> <?= $curentUser->getCurrency()->getTitle(); ?></i>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="ps-cart__total">
                                    <p>Number of items:<span><?= count($cart->getProducts()); ?></span></p>
                                    <p>Item Total:<span><?= $cart->getProductsPrice(); ?> <span><?= $curentUser->getCurrency()->getTitle(); ?></span></span></p>
                                </div>
                            <?php else : ?>
                                <p>Корзина пуста</p>
                            <?php endif; ?>
                        </div>
                        <div class="ps-cart__footer"><a class="ps-btn" href="/cart">Check out<i class="ps-icon-arrow-left"></i></a></div>
                    </div>
                </div>
                <div class="menu-toggle"><span></span></div>
            </div>
        </div>
    </nav>
</header>
<!--<div class="header-services">
    <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with Sky Store</p>
    </div>
</div>-->