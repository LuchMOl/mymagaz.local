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

?>