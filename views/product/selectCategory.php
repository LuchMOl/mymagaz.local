<?php require_once '/../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><h1>Выбрать категорий</h1><hr>
            <form method = 'post' action = ''>
                <?php

                $i = 0;
                foreach ($categories as $category) {
                    echo "<input name = '$i' type = 'checkbox'> $category</input><br><br>";
                    $i = $i + 1;
                }
                ?>
                <input name = 'newCategory' type = 'text'></input>
                <input name = 'insertNewCategory' type = submit value = 'Добавить новую категорию'><br><br>
                <input name = 'insertNewProduct' type = submit value = 'Записать продукт в базу'>
            </form>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../layouts/footer.php'; ?>