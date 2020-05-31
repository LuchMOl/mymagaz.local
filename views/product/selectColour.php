<?php require_once '/../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><h1>Выбрать количество цвета</h1><hr>

            <form method = 'post' action = ''>
                <?php

                $i = 0;
                foreach ($colours as $colour) {
                    echo "<input name = '$i' type = 'number'> $colour</input><br><br>";
                    $i = $i + 1;
                }
                ?>
                <input name = 'newColour' type = 'text'></input>
                <input name = 'insertNewColour' type = submit value = 'Добавить новый цвет'><br><br>
                <input name = 'next' type = submit value = 'Далее >>'>
            </form>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../layouts/footer.php'; ?>