
<?php

class TasksService
{

    var $dir;
    var $counter;
    var $files;
    var $file;
    var $third;

    public function getFilesNames()
    //возвращает масиив с именами файлов в папке $dir
    {
        $dir = '../views/tasks';
        return scandir($dir);
    }

    public function getTask($third)
    //возвращает содержимое файла $third в виде строки (если $third существует в маршруте и соответствует файлу в папке $dir)
    {
        $files = $this->getFilesNames();
        if (in_array($third, $files)) {
            return file_get_contents("../views/tasks/$third");
        } else if ($third !== '') {
            echo 'ОШИБКА! Такого задания нет!';
        }
    }

    public function renderTasksList()
    //выводит список маршрутов к файлам в папке $dir
    {
        $files = $this->getFilesNames();
        $counter = 0;
        foreach ($files as $file) {
            if ($counter > 1) {
                echo "<a href = '$file'>$file</a><br>";
            }
            $counter++;
        }
    }

}

?>
