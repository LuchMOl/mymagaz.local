<?php require_once '/../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>

    <div class='container'><h2>Register</h2><hr>

        <form method = 'post' action = ''>
            <input name = 'email'    type = 'text' maxlength = '30' size = '30' placeholder = 'email'    /><br><br>
            <input name = 'name' type = 'text' maxlength = '20' size = '30' placeholder = 'name' /><br><br>
            <input name = 'password' type = 'password' maxlength = '20' size = '30' placeholder = 'password' /><br><hr>
            <input name = 'submit' type = submit value = 'Register'>
        </form>
        <?php echo $message; ?>
    </div>
</section>

<?php require_once '/../layouts/footer.php'; ?>