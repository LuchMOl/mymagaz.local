
<?php

class TasksService
{
    public function getFilesNames()
    {
        $dir = '../views/tasks';
        return scandir($dir);
    }

    public function getTask($third)
    {
        require "../views/tasks/$third";
    }

}

?>
