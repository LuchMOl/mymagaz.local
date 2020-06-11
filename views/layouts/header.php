<?php include_once '/head.php'; ?>
<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                    <p>460 West 34th Street, 15th floor, New York  -  Hotline: 804-377-3580 - 804-399-3580</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                    <div class="header__actions"><a href="#">Login & Regiser</a>
                        <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">USD<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="/images/flag/usa.svg" alt=""> USD</a></li>
                                <li><a href="#"><img src="/images/flag/singapore.svg" alt=""> SGD</a></li>
                                <li><a href="#"><img src="/images/flag/japan.svg" alt=""> JPN</a></li>
                            </ul>
                        </div>
                        <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language<i class="fa fa-angle-down"></i></a>
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
                if ($_SERVER['REQUEST_URI'] === '/') {
                    include_once '/topmenu.php';
                }
                ?>
            </div>
            <!--            <div class="navigation__column right">
                            <form class="ps-search--header" action="do_action" method="post">
                                <input class="form-control" type="text" placeholder="Search Product…">
                                <button><i class="ps-icon-search"></i></button>
                            </form>
                            <div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i>20</i></span><i class="ps-icon-shopping-cart"></i></a>
                                <div class="ps-cart__listing">
                                    <div class="ps-cart__content">
                                        <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                                            <div class="ps-cart-item__thumbnail"><a href="product-detail.html"></a><img src="/images/cart-preview/1.jpg" alt=""></div>
                                            <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="product-detail.html">Amazin’ Glazin’</a>
                                                <p><span>Quantity:<i>12</i></span><span>Total:<i>£176</i></span></p>
                                            </div>
                                        </div>
                                        <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                                            <div class="ps-cart-item__thumbnail"><a href="product-detail.html"></a><img src="/images/cart-preview/2.jpg" alt=""></div>
                                            <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="product-detail.html">The Crusty Croissant</a>
                                                <p><span>Quantity:<i>12</i></span><span>Total:<i>£176</i></span></p>
                                            </div>
                                        </div>
                                        <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                                            <div class="ps-cart-item__thumbnail"><a href="product-detail.html"></a><img src="/images/cart-preview/3.jpg" alt=""></div>
                                            <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="product-detail.html">The Rolling Pin</a>
                                                <p><span>Quantity:<i>12</i></span><span>Total:<i>£176</i></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-cart__total">
                                        <p>Number of items:<span>36</span></p>
                                        <p>Item Total:<span>£528.00</span></p>
                                    </div>
                                    <div class="ps-cart__footer"><a class="ps-btn" href="cart.html">Check out<i class="ps-icon-arrow-left"></i></a></div>
                                </div>
                            </div>
                            <div class="menu-toggle"><span></span></div>
                        </div>-->
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