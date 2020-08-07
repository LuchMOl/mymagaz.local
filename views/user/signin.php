<?php require_once '../views/layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>

    <div class='container'><h2>SignIn</h2><hr>

        <form method = 'post' action = '/user/signin/'>
            <input name = 'email'    type = 'text' maxlength = '30' size = '30' placeholder = 'email'    /><br><br>
            <input name = 'password' type = 'password' maxlength = '20' size = '30' placeholder = 'password' /><br><hr>
            <input name = 'submit' type = submit value = 'Sign In'>
        </form>

        <?php echo $message; ?>
    </div>
</section>

<?php require_once '../views/layouts/footer.php'; ?>