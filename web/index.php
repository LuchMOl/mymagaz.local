<?php

use app\services\TestServiceToShowNamespace2;
use app\services\RouteService;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

$autoloaderFileName = dirname(__DIR__) . '/vendor/autoload.php';
if (file_exists($autoloaderFileName)) {
    require_once $autoloaderFileName;
} else {
    die;
}

if (isset($_GET['testNamespace'])) {
    $autoloaderFileName = dirname(__DIR__) . '/vendor/autoload.php';
    if (file_exists($autoloaderFileName)) {
        require_once $autoloaderFileName;
    } else {
        die('Зайди с консоли в корень проекта и запусти команду php composer.phar update. Теперь обнови страницу.');
    }
    $t = new app\services\TestServiceToShowNamespace;
    $t->showMeYourLove();
    $t2 = new TestServiceToShowNamespace2;
    $t2->showMeYourGaga();
    die;
} else {
    //require_once '../autoLoader.php';
    //spl_autoload_register('autoLoader');
}
?>
<?php

session_start();

$routeService = new RouteService();
$routeService->run();

//var_dump($_SESSION['product']);
//header("Location:".$_SERVER['REQUEST_URI']); // перенаправление на ту же страницу
?>