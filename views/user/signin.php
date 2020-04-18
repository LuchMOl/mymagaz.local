    <?php
    require 'footer.php';
    echo '1';
    ?>
<div class='container'><h2>SignIn</h2><hr>

    <form method = 'post' action = '/user/signin/'>
        <input name = 'email'    type = 'text' maxlength = '30' size = '30' placeholder = 'email'    /><br><br>
        <input name = 'password' type = 'text' maxlength = '20' size = '30' placeholder = 'password' /><br><hr>
        <input name = 'submit' type = submit value = 'Sign In'></form>