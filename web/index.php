<! -- errors -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<! -- includs -->
<?php
include '../services/RouteService.php';
include '../services/TasksService.php';
?>

<! -- routeService -->
<?php
$routeService = new RouteService();

if ($routeService->getFirstPart() != NULL) {
    $first = $routeService->getFirstPart();
    echo "1.$first. ";
    if ($routeService->getSecondPart() != NULL) {
        $Second = $routeService->getSecondPart();
        echo "2.$Second. ";
        if ($routeService->getThirdPart() != NULL) {
            $Third = $routeService->getThirdPart();
            echo "3.$Third. ";
        }
    }
}
?>

<! -- tasks -->
<?php
echo "<a href='http://mymagaz.local/views/tasks/'><br><br>tasks<br><br></a>";

if ($routeService->getFirstPart() === 'views') {
    if ($routeService->getSecondPart() === 'tasks') {

        $tasksService = new TasksService();
        $files = $tasksService->getFilesNames();

        $counter = 0;
        foreach ($files as $file) {
            if ($counter > 1) {
                echo "<a href = '$file'>$file</a><br>";
            }
            $counter++;
        }

        $third = $routeService->getThirdPart();

        if ($third != NULL) {
            if (in_array("$third", $files)) {
                $tasksService->getTask($third);
            } else {
                echo 'ОШИБКА. ТАКОГО ЗАДАНИЯ НЕТ.';
            }
        }
    }
}
?>