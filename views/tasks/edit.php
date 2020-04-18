<?php echo "<div class='container'><h2>Edit: $third</h2><hr>"; ?>

<form method = 'post' action = ''>
    <textarea rows="30" cols="137" name="text"><?php echo file_get_contents("../views/tasks/$third"); ?></textarea><br><br><hr>
    <input name = 'submit' type = submit value = 'Write'></form>