<?php

namespace app\views\product\colour;

require_once dirname(__DIR__) . '../../layouts/admin/header.php';
?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><h1>Цвета</h1><hr>
            <ul>
                <li><a href = '/colour/createNew/'>Добавить новый цвет</a><br><br></li>
                <li><a href = '/colour/showAll/'>Список всех цветов</a><br><br></li>
            </ul><hr>
        </div>
    </div>
</section>
<?php require_once dirname(__DIR__) . '../../layouts/admin/footer.php'; ?>