<?php

namespace app\views\layouts;

use app\services\CategoryService;

$categoryService = new CategoryService();
$categories = $categoryService->getActivityCategories();
$countMenu = 1;
$menu = 5;
$subMenu = 7;
$megaColumn = 4;
$megaItem = 5;
?>
<?php $categories = CategoryService::getSortRank($categories, ''); ?>
<?php foreach ($categories as $category) : ?>
    <ul class='main-menu menu'>
        <?php if ($category->isTopMenu() AND $countMenu <= $menu) : ?>
            <?php if (!$category->hasChildren()) : ?>
                <li class='menu-item'><a href='/catalog/<?= $category->id; ?>/'><?= $category->name; ?></a></li>
            <?php else : ?>
                <?php if (!$category->childrenHasChildren()) : ?>
                    <li class='menu-item menu-item-has-children dropdown'><a href='/catalog/<?= $category->id; ?>/'><?= $category->name; ?></a>
                        <ul class='sub-menu'>
                            <?php $childrens = CategoryService::getSortRank($category->children, ''); ?>
                            <?php $countSubMenu = 1; ?>
                            <?php foreach ($childrens as $children) : ?>
                                <?php if ($countSubMenu <= $subMenu) : ?>
                                    <li class='menu-item'><a href='/catalog/<?= $children->id; ?>/'><?= $children->name; ?></a></li>
                                <?php endif; ?>
                                <?php $countSubMenu++; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class='menu-item menu-item-has-children has-mega-menu'><a href='/catalog/<?= $category->id; ?>'><?= $category->name; ?></a>
                        <div class='mega-menu'>
                            <div class='mega-wrap'>
                                <?php $childrens = CategoryService::getSortRank($category->children, ''); ?>
                                <?php $countMegaColumn = 1; ?>
                                <?php foreach ($childrens as $children) : ?>
                                    <?php if ($countMegaColumn <= $megaColumn) : ?>
                                        <div class='mega-column'>
                                            <h4 class='mega-heading'><a href='/catalog/<?= $children->id; ?>/'><?= $children->name; ?></a></h4>
                                            <ul class='mega-item'>
                                                <?php $childr = CategoryService::getSortABC($children->children); ?>
                                                <?php $countMegaItem = 1; ?>
                                                <?php foreach ($childr as $child) : ?>
                                                    <?php if ($countMegaItem <= $megaItem) : ?>
                                                        <li><a href='/catalog/<?= $child->id; ?>/'><?= $child->name; ?></a></li>
                                                    <?php endif; ?>
                                                    <?php $countMegaItem++; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <?php $countMegaColumn++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            <?php
            endif;
            $countMenu++;
            ?>
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