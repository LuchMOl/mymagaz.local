<?php

namespace app\views\tasks;

require_once '../views/layouts/admin/header.php';
?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'>
            <h2><?= $third; ?></h2><hr>
            <ul>
<?php foreach ($content as $value) : ?>
    <?= $value; ?><br>
<?php endforeach; ?>
                <hr>
                <li><a href = '/tasks/edit/<?= $third; ?>'>Edit Task</a></li>
            </ul>
        </div>
    </div>
</section>

<?php require_once '../views/layouts/admin/footer.php'; ?>