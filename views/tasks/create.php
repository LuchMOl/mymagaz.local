<?php require_once '/../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'>
            <h2>Create New Task File: <?php echo "$this->newFileName" ?></h2><hr>

            <form method = 'post' action = ''>
                <textarea rows="30" cols="137" name="text"></textarea><br><br><hr>
                <input name = 'submit' type = submit value = 'Write'></input>
            </form>

        </div>
    </div>
</section>

<?php require_once '/../layouts/footer.php'; ?>