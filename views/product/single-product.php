<?php require_once("../views/layouts/header.php");
$imageDir = '/images/products/';
?>
<!--
<div class="breadcumbs">
    <div class="container">
        <div class="row">
            <span>Home > </span>
            <span>Men > </span>
            <span>Eyewear > </span>
            <span>Blue Jacket</span>
        </div>
    </div>
</div>
-->
<div class="short-description">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-thumbnail">
                    <!--
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <ul class="thumb-image">
                            <li class="active"><a href="/images/products/single-product-1.jpg"><img src="/images/products/single-product-1.jpg" alt=""></a></li>
                            <li><a href="/images/products/single-product-2.jpg"><img src="/images/products/single-product-2.jpg" alt=""></a></li>
                            <li><a href="/images/products/single-product-3.jpg"><img src="/images/products/single-product-3.jpg" alt=""></a></li>
                            <li><a href=""><img src="/images/products/single-product-4.jpg" alt=""></a></li>
                            <li><a href=""><img src="/images/products/single-product-5.jpg" alt=""></a></li>
                        </ul>
                    </div>
                    -->
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <div class="thumb-main-image"><a href=""><img src="<?= $imageDir . $product->imageName[0]; ?>" alt=""></a></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-6">
                <h1 class="product-title"><?=$product->name?></h1>
                <div class="ratings">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span class="vote-count">35 vote</span>
                </div>
                <div class="product-info">
                    <span class="product-id"><span class="strong-text">Product ID:</span> RST 4562</span>

                    <span class="product-avilability"><span class="strong-text">Availability:</span> In Stock</span>
                </div>
                <p class="short-info">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend ex mea. His at soluta regione diceret, cum et atqui placerat petentium. Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, lie diceret, cum et atqui placerat petentium.</p>
                <div class="price">
                    <span>$522.00</span>
                </div>
                <form action="" class="purchase-form">
                    <div class="qt-area">
                        <i class="fa fa-minus"></i>
                        <input name="quantity" class="qt" value="1">
                        <i class="fa fa-plus"></i>
                    </div>

                    <button class="btn btn-theme" type="submit">Add to cart</button>
                    <div class="social-share">
                        <ul>
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </form>
                <p><span class="strong-text">Categories:</span> Pants, T-Shirt, Jama</p>
                <p><span class="strong-text">Tags:</span> GonShop, theme-sky, woocommerce, wordpress</p>

                <ul class="product-info-btn">
                    <li><a href=""><i class="fa fa-heart-o"></i> Wishlist</a></li>
                    <li><a href=""><i class="fa fa-arrows-h"></i> Compare</a></li>
                    <li><a href=""><i class="fa fa-envelope-o"></i> Email</a></li>
                    <li><a href=""><i class="fa fa-print"></i> Print</a></li>
                </ul>
                <p><i class="fa fa-check"></i> Let’s start with the most essential part of any written content. At the early </p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="single-product-tabs">
            <ul class="nav nav-tabs nav-single-product-tabs">
                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <div class="product-desc">
                        <h2>Product Description</h2>
                        <p>Ultricies et consectetur rhoncus lorem mattis, ligula interdum nibh dolor ipsum, venenatis ultrices sem nisl senectus phasellus lectus facilisis gravida curabitur interdum pretium et pellentesque nullam auctor vestibulum aenean ipsum placerat erat volutpat lectus mi est lacinia sociosqu, pretium habitasse aenean eros tristique augue a vivamus ac, sapien blandit nullam et neque curabitur varius nostra dui dictum cras orci congue.  Ultricies et consectetur rhoncus lorem mattis, ligula interdum nibh dolor ipsum, venenatis ultrices sem nisl senectus phasellus lectus facilisis gravida curabitur interdum pretium et pellentesque nullam auctor vestibulum aenean ipsum placerat</p>
                    </div>
                </div>
                <div class="tab-pane" id="reviews">
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>