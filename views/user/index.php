<?php

namespace app\views\user;

require_once '../views/layouts/header.php';
?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><hr>
            <ul>
                <li><a href = '/user/signin/'>SignIn</a></li>
                <li><a href = '/user/register/'>Register</a></li>
                <li><a href = '/user/exit/'>Exit</a></li>
            </ul><hr>
        </div>
    </div>
</section>

<?php require_once '../views/layouts/footer.php'; ?>