<?php

class TaskController
{

    public function __construct()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        echo '<a href="http://mymagaz.local/task/create/">createNew<br><br></a>';
    }

    public function actionIndex()
    //выводит список маршрутов к файлам в папке $dir
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        $counter = 0;
        foreach (StaticService::getFilesNames('../views/tasks') as $file) {
            if ($counter > 1) {
                echo "<a href = 'http://mymagaz.local/task/view/$file'>$file</a><br>";
            }
            $counter++;
        }
    }

    public function actionView($third)
    //возвращает содержимое файла $third в виде строки (если $third существует в маршруте и соответствует файлу в папке $dir)
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        $filename = "../views/tasks/$third";

        if (file_exists($filename)) {
            echo file_get_contents("../views/tasks/$third");
        } else {
            echo "Файл $filename не существует";
        }
    }

    public function actionCreate()
    {
        echo __CLASS__ . '<br>' . __METHOD__ . '<br><br>';

        echo 'Тут создание нового файла задания.<br>';

        /*  echo '<form action="write" method="post">
          <p>Имя файла: <input type="text" name="name" /></p>
          <p>Текст: <textarea name="comment"></textarea></p>
          <p><input type="submit" /></p>
          </form>';
          }

          public function actionWrite($fileName)
          {
          if (!file_exists("../views/tasks/$fileName")) {
          $data = $_POST['comment'];
          $content = "
          <!DOCTYPE html>
          <html>
          <head>
          <meta charset='UTF-8'>
          </head>
          <body>
          $data
          </body>
          </html>";
          file_put_contents("../views/tasks/$fileName", $content);
          echo "Создан файл с именем $fileName!";
          } else {
          echo "Файл с именем $fileName уже существует!";
          } */
    }

}