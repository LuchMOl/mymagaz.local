<?php require_once '/../../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br><h1><a href = '/product/'>< Работа с товарами</a> |
                <a href = '/product/category/'>< Управление категориями</a> |
                Все категории</h1><hr>
            <table>
                <?php
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $get = str_replace(' ', '_', $category);
                        echo "<tr>"
                        . "<td style='padding-right: 40px'>$category</td>"
                        . "<td style='padding-right: 40px'><ul><li><a href = /product/editCategory/?categoryname=$get>Редактировать</a></li></ul></td>"
                        . "<td><ul><li><a href = /product/dellCategory/?categoryname=$get> Удалить</a></li></ul></td>"
                        . "</tr>";
                    }
                } else {
                    echo 'В базе нет ни одной категории';
                }
                ?>
            </table>
            <br><ul><li><a href = '/product/createNewCategory/'>Создать новую категорию</a><br><br></li></ul><hr>
        </div>
    </div>
</section>
<?php require_once '/../../layouts/footer.php'; ?>