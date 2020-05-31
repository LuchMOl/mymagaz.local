<?php require_once '/../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><h1>Все товары</h1><hr>
            <ul>
                <?php
                if (is_array($products)) {
                    foreach ($products as $product) {
                        echo "<li><a href = /product/showProduct/?name=$product[name]>"
                        . "$product[name]<br>"
                        . "<img src='/images/products/{$product['images']['0']}' width='100' height='100'/>"
                        . "</a><br><br></li>";
                    }
                }else{
                    echo 'В базе нет ни одного продукта';
                }
                ?>
            </ul><hr>
        </div>
    </div>
</section>
<?php require_once '/../layouts/footer.php'; ?>