
<?php
$categoryService = new CategoryService();
$categories = $categoryService->getCategories('top');
foreach ($categories as $key => $category) :
    ?>
    <ul class='main-menu menu'>
        <?php if (empty($category)) : ?>
            <li class='menu-item'><a href='<?= $key ?>'><?= $key ?></a></li>
        <?php else : ?>
            <?php if (!array_filter($category)) : ?>
                <li class='menu-item menu-item-has-children dropdown'><a href='<?= $key ?>'><?= $key ?></a>
                    <ul class='sub-menu'>
                        <?php foreach ($category as $key => $value) : ?>
                            <li class='menu-item'><a href='<?= $key ?>'><?= $key ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else : ?>
                <li class='menu-item menu-item-has-children has-mega-menu'><a href='<?= $key ?>'><?= $key ?></a>
                    <div class='mega-menu'>
                        <div class='mega-wrap'>
                            <?php foreach ($category as $key => $value) : ?>
                                <div class='mega-column'>
                                    <h4 class='mega-heading'><?= $key ?></h4>
                                    <ul class='mega-item'>
                                        <?php foreach ($value as $item) : ?>
                                            <li><a href='<?= $item ?>'><?= $item ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
<?php endforeach; ?>





<!--
<ul class="main-menu menu">
    <li class="menu-item menu-item-has-children dropdown"><a href="index.html">Home</a>
        <ul class="sub-menu">
            <li class="menu-item"><a href="index.html">Homepage #1</a></li>
            <li class="menu-item"><a href="#">Homepage #2</a></li>
            <li class="menu-item"><a href="#">Homepage #3</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-has-children has-mega-menu"><a href="#">Men</a>
        <div class="mega-menu">
            <div class="mega-wrap">
                <!--<div class="mega-column">
                    <ul class="mega-item mega-features">
                        <li><a href="product-listing.html">NEW RELEASES</a></li>
                        <li><a href="product-listing.html">FEATURES SHOES</a></li>
                        <li><a href="product-listing.html">BEST SELLERS</a></li>
                        <li><a href="product-listing.html">NOW TRENDING</a></li>
                        <li><a href="product-listing.html">SUMMER ESSENTIALS</a></li>
                        <li><a href="product-listing.html">MOTHER'S DAY COLLECTION</a></li>
                        <li><a href="product-listing.html">FAN GEAR</a></li>
                    </ul>
                </div>--><!--
                <div class="mega-column">
                    <h4 class="mega-heading">Shoes</h4>
                    <ul class="mega-item">
                        <li><a href="product-listing.html">All Shoes</a></li>
                        <li><a href="product-listing.html">Running</a></li>
                        <li><a href="product-listing.html">Training & Gym</a></li>
                        <li><a href="product-listing.html">Basketball</a></li>
                        <li><a href="product-listing.html">Football</a></li>
                        <li><a href="product-listing.html">Soccer</a></li>
                        <li><a href="product-listing.html">Baseball</a></li>
                    </ul>
                </div>
                <div class="mega-column">
                    <h4 class="mega-heading">CLOTHING</h4>
                    <ul class="mega-item">
                        <li><a href="product-listing.html">Compression & Nike Pro</a></li>
                        <li><a href="product-listing.html">Tops & T-Shirts</a></li>
                        <li><a href="product-listing.html">Polos</a></li>
                        <li><a href="product-listing.html">Hoodies & Sweatshirts</a></li>
                        <li><a href="product-listing.html">Jackets & Vests</a></li>
                        <li><a href="product-listing.html">Pants & Tights</a></li>
                        <li><a href="product-listing.html">Shorts</a></li>
                    </ul>
                </div>
                <div class="mega-column">
                    <h4 class="mega-heading">Accessories</h4>
                    <ul class="mega-item">
                        <li><a href="product-listing.html">Compression & Nike Pro</a></li>
                        <li><a href="product-listing.html">Tops & T-Shirts</a></li>
                        <li><a href="product-listing.html">Polos</a></li>
                        <li><a href="product-listing.html">Hoodies & Sweatshirts</a></li>
                        <li><a href="product-listing.html">Jackets & Vests</a></li>
                        <li><a href="product-listing.html">Pants & Tights</a></li>
                        <li><a href="product-listing.html">Shorts</a></li>
                    </ul>
                </div>
                <div class="mega-column">
                    <h4 class="mega-heading">BRAND</h4>
                    <ul class="mega-item">
                        <li><a href="product-listing.html">NIKE</a></li>
                        <li><a href="product-listing.html">Adidas</a></li>
                        <li><a href="product-listing.html">Dior</a></li>
                        <li><a href="product-listing.html">B&G</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="menu-item"><a href="#">Women</a></li>
    <li class="menu-item"><a href="#">Kids</a></li>
    <li class="menu-item menu-item-has-children dropdown"><a href="#">News</a>
        <ul class="sub-menu">
            <li class="menu-item menu-item-has-children dropdown"><a href="blog-grid.html">Blog-grid</a>
                <ul class="sub-menu">
                    <li class="menu-item"><a href="blog-grid.html">Blog Grid 1</a></li>
                    <li class="menu-item"><a href="blog-grid-2.html">Blog Grid 2</a></li>
                </ul>
            </li>
            <li class="menu-item"><a href="blog-list.html">Blog List</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-has-children dropdown"><a href="#">Contact</a>
        <ul class="sub-menu">
            <li class="menu-item"><a href="contact-us.html">Contact Us #1</a></li>
            <li class="menu-item"><a href="contact-us.html">Contact Us #2</a></li>
        </ul>
    </li>
</ul>-->