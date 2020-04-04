<?php

class TaskController
{

    public function actionIndex()
    {
        StaticService::renderLinks();
        $counter = 0;
        foreach (StaticService::getFilesNames('../views/tasks') as $file) {
            if ($counter > 1) {
                echo "<a href = 'http://mymagaz.local/task/view/$file'>$file</a><br>";
            }
            $counter++;
        }
    }

    public function actionView($third)
    {
        $filename = "../views/tasks/$third";
        if (!file_exists($filename)) {
            StaticService::return404();
        } else {
            echo file_get_contents("../views/tasks/$third");
        }
    }

    public function actionCreate()
    {
        echo 'Тут создание нового файла задания.<br>';
    }

}
