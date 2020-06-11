<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require_once '../autoLoader.php';
spl_autoload_register('autoLoader');
?>
<?php
session_start();

$routeService = new RouteService();
$routeService->run();

//var_dump($_SESSION['product']);
//header("Location:".$_SERVER['REQUEST_URI']); // перенаправление на ту же страницу
?>