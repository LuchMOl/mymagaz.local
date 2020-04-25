<?php

class TasksController
{

    private $newTaskNumber;
    private $newFileName;
    private $taskList;
    public $handle;

    public function actionIndex()
    {
        $taskList = scandir('../views/tasks');
        $exclusion = ['view.php', 'index.php', 'create.php', 'edit.php'];
        $notFile = array_filter($taskList, 'file_exists');
        $taskList = array_diff($taskList, $exclusion, $notFile);
        natcasesort($taskList);
        $taskList = array_reverse($taskList);

        require_once '../views/tasks/index.php';
    }

    public function actionView($third)
    {
        $fileName = "../views/tasks/$third";
        if (!file_exists($fileName)) {
            StaticService::return404();
        } else {
            $content = file($fileName);
            require_once '/../views/tasks/view.php';
        }
    }

    public function actionCreate()
    {
        $this->newTaskNumber = max(preg_replace("/[^0-9]/", '', scandir('../views/tasks'))) + 1;
        $this->newFileName = 'task' . $this->newTaskNumber . '.txt';

        if (isset($_POST["submit"])) {
            if (!empty($_POST["text"])) {
                $fp = fopen("../views/tasks/$this->newFileName", "w");
                fwrite($fp, $_POST["text"]);
                fclose($fp);
            }
            header("Location: http://mymagaz.local/tasks/view/$this->newFileName");
        }
    }

    public function actionEdit($third)
    {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["text"])) {
                $fp = fopen("../views/tasks/$third", "w+");
                fwrite($fp, $_POST["text"]);
                fclose($fp);
            }
            header("Location: http://mymagaz.local/tasks/view/$third");
        }
        require_once '/../views/tasks/edit.php';
    }

}
