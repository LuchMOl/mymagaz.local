<?php

class TasksController
{

    private $newTaskNumber;
    private $newFileName;
    private $taskList;

    function __construct()
    {
        echo "
            <section id='newsletter'  class='newsletter'>
                <div class='container'>
					<div class='hm-foot-menu'>
                    <ul>
            ";
    }

    public function actionIndex()
    {
        echo "<h4>Tasks list</h4><hr>";

        $taskList = scandir('../views/tasks');
        natcasesort($taskList);
        foreach (array_reverse($taskList) as $file) {
            if (is_file("../views/tasks/$file") && $file !== 'index.php') {
                echo "<li><a href = '/tasks/view/$file'>$file</a></li>";
            }
        }
        echo "<hr><a href = '/tasks/create/'>Create New Task</a>";
    }

    public function actionView($third)
    {
        $fileName = "../views/tasks/$third";
        if (!file_exists($fileName)) {
            StaticService::return404();
        } else {
            echo "<h2>$third</h2><hr>";
            echo file_get_contents("../views/tasks/$third");
            /* echo "<hr><form name='editTask' method='post' action=''>
              <input value='Edit Task' type='submit' name='editTask'/>
              </form>";
              if (isset($_POST['editTask'])) {
              $this->actionEdit($third);
              } */
        }
    }

    public function actionCreate()
    {

        $this->newTaskNumber = max(preg_replace("/[^0-9]/", '', scandir('../views/tasks'))) + 1;
        $this->newFileName = 'task' . $this->newTaskNumber . '.html';

        echo "<h2>Create New Task File: $this->newFileName</h2><hr>";

        echo file_get_contents("../views/tasks/index.php");

        if (!empty($_POST["text"])) {
            $fp = fopen("../views/tasks/$this->newFileName", "w");
            fwrite($fp, $_POST["text"]);
            fclose($fp);
        }
    }

    public function actionEdit($third)
    {
        echo $third;

        echo file_get_contents("../views/tasks/index.php");
        /* if (!empty($_POST["text"])) {
          $fp = fopen("../views/tasks/$third", "w+");
          fwrite($fp, $_POST["text"]);
          fclose($fp);
          } */
    }

    function __destruct()
    {
        echo "</ul>
                </div>
                    </div>
                </section>
             ";
    }

}
