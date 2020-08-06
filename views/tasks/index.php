<?php require_once '/../views/layouts/admin/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'>
            <h4>Tasks list</h4><hr>
            <ul>
                <?php foreach ($taskList as $file) : ?>
                    <li><a href = '/tasks/view/<?= $file; ?>'><?= $file; ?></a></li>
                <?php endforeach; ?>
                <hr>
                <li><a href = '/tasks/create/'>Create New Task</a></li>
            </ul>
        </div>
    </div>
</section>

<?php require_once '/../views/layouts/admin/footer.php'; ?>