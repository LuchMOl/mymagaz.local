<! -- errors -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<! -- includs -->
<?php
include '../services/RouteService.php';
include '../views/Tasks/tasks.php';
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
        /* if ($routeService->getThirdPart() != NULL) {
          $Third = $routeService->getThirdPart();
          echo "3.$Third. ";
          } */
    }
}
?>

<! -- tasks -->
<a href="http://mymagaz.local/tasks/contents"><br><br>tasks</a>
<?php
$task = new Task();

if ($routeService->getFirstPart() === 'tasks') {
    echo "<br><br>";
    echo "<a href='http://mymagaz.local/tasks/1'> 1 </a>";
    echo "<a href='http://mymagaz.local/tasks/2'> 2 </a>";
    echo "<a href='http://mymagaz.local/tasks/3'> 3 </a>";
    echo "<a href='http://mymagaz.local/tasks/4'> 4 </a>";

    if ($routeService->getSecondPart() != NULL) {
        if ($routeService->getSecondPart() === '1') {
            $task->taskOne();
        }
        if ($routeService->getSecondPart() === '2') {
            $task->taskTwo();
        }
        if ($routeService->getSecondPart() === '3') {
            $task->taskThree();
        }
        if ($routeService->getSecondPart() === '4') {
            $task->taskFour();
        }
    }
}
?>