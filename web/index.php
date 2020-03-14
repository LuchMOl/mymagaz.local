<! -- errors -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<! -- includs -->
<?php
require '../services/AutoLoadServices.php';
$autoLoadServices = new AutoLoadServices();
?>

<a href='http://mymagaz.local/views/tasks/'><br><br>tasks<br><br></a>

<! -- task 5 -->
<?php
//echo ImageService::getImgTag('1');
//echo ImageService::getImgTag('1', '100px');
//echo ImageService::getImgTag('1', '.png');
//echo ImageService::getImgTag('3211');
//echo ImageService::getImgTag('1', '.jpg');
//echo ImageService::getImgTag('1', '.png', '100px', '300px');
?>

<! -- tasks -->
<?php
$routeService = new RouteService();

if ($routeService->getFirstPart() === 'views' && $routeService->getSecondPart() === 'tasks') {

    $tasksService = new TasksService();

    $tasksService->renderTasksList();

    echo $tasksService->getTask($routeService->getThirdPart());
}
?>