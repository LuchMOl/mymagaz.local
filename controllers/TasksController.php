<?php

class TasksController
{

    private $newTaskNumber;
    private $newFileName;
    private $taskList;
    public $handle;

    public function actionIndex()
    {
        require_once '/../views/layouts/header.php';
        echo "<div class='container'><h4>Tasks list</h4><hr>";

        $taskList = scandir('../views/tasks');
        natcasesort($taskList);
        foreach (array_reverse($taskList) as $file) {
            if (is_file("../views/tasks/$file") && $file !== 'create.php' && $file !== 'edit.php') {
                echo "<li><a href = '/tasks/view/$file'>$file</a></li>";
            }
        }
        echo "<hr><li><a href = '/tasks/create/'>Create New Task</a></li>";
        require_once '/../views/layouts/footer.php';
    }

    public function actionView($third)
    {
        require_once '/../views/layouts/header.php';
        $fileName = "../views/tasks/$third";
        if (!file_exists($fileName)) {
            StaticService::return404();
        } else {
            echo "<div class='container'><h2>$third</h2><hr>";

            $content = file($fileName);
            foreach ($content as $value) {
                echo "$value <br>";
            }
        }
        echo "<hr><li><a href = '/tasks/edit/$third'>Edit Task</a></li>";

        require_once '/../views/layouts/footer.php';
    }

    public function actionCreate()
    {
        require_once '/../views/layouts/header.php';
        $this->newTaskNumber = max(preg_replace("/[^0-9]/", '', scandir('../views/tasks'))) + 1;
        $this->newFileName = 'task' . $this->newTaskNumber . '.txt';

        require_once "../views/tasks/create.php";

        if (isset($_POST["submit"])) {
            if (!empty($_POST["text"])) {
                $fp = fopen("../views/tasks/$this->newFileName", "w");
                fwrite($fp, $_POST["text"]);
                fclose($fp);
            }
            echo "<script>location.href= '/tasks/view/$this->newFileName';</script>";
        }
        require_once '/../views/layouts/footer.php';
    }

    public function actionEdit($third)
    {
        require_once "/../views/layouts/header.php";

        require_once "../views/tasks/edit.php";

        if (isset($_POST["submit"])) {
            if (!empty($_POST["text"])) {
                $fp = fopen("../views/tasks/$third", "w+");
                fwrite($fp, $_POST["text"]);
                fclose($fp);
            }
            echo "<script>location.href= '/tasks/view/$third';</script>";
        }
        require_once '/../views/layouts/footer.php';
    }

}
