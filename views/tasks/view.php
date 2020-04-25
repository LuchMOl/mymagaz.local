<?php require_once '/../layouts/header.php'; ?>

<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>

           <div class='container'>
               <h2><?php echo $third ?></h2><hr>
               <ul>
                               <?php foreach ($content as $value) {
                echo "$value <br>";
            }?>


                <?php echo "<hr><li><a href = '/tasks/edit/$third'>Edit Task</a></li>"; ?>
            </ul>
        </div>
    </div>
</section>

<?php require_once '/../layouts/footer.php'; ?>