<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><p><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/category/'>< Управление категориями</a> |
                Список всех категорий</p><hr>

            <?php
            if (!empty($categories)) {
                foreach ($categories as $superCategory => $category) {
                    echo "<p><h3>$superCategory</h3><br>";
                    foreach ($category as $parent => $SeniorChildren) {
                        echo "<b>$parent</b><br>";
                        foreach ($SeniorChildren as $Child) {
                            echo "<i>$Child</i><br>";
                        }
                    }echo '</p>';
                }
            }
            ?>

            <br><ul><li><a href = '/category/createNewCategory/'>Создать новую категорию</a><br><br></li></ul>
            <?= $mesage ?>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>