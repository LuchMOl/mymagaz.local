<?php

namespace app\views\product\category;

require_once '../views/layouts/admin/header.php';
?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><br>
            <p><a href = '/product/'>< Работа с товарами</a> |
                Управление категориями</p><hr>

            <h2>Категории</h2><br>
            <ul>
                <li><a href = '/category/createNew/'>Создать новую категорию</a><br><br></li>
                <li><a href = '/category/showAll/'>Список всех категорий</a><br><br></li>
                <li><a href = '/category/showAll/?show=topMenu'>Список категорий Топ Меню</a><br><br></li>
            </ul><hr>
        </div>
    </div>
</section>
<?php require_once '../views/layouts/admin/footer.php'; ?>