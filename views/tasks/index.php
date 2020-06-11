<?php require_once '/../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'>
            <h4>Tasks list</h4><hr>
            <ul>

                <?php
                foreach ($taskList as $file) {
                    echo "<li><a href = '/tasks/view/$file'>$file</a></li>";
                }
                ?>

                <hr><li><a href = '/tasks/create/'>Create New Task</a></li>
            </ul>
        </div>
    </div>
</section>

<?php require_once '/../layouts/footer.php'; ?>