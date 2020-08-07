<?php

use app\services\TestServiceToShowNamespace2;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

if (isset($_GET['testNamespace'])) {
    /*
     что бы это работало тебе нужно зайти с консоли в корень нашего проекта типа C:\blala\mymagaz.local\
     и запустить команду php composer.phar update
     тебе создаст папку vendor и там появится файл. Настройки находятся в файле composer.json.
     Это позволяет сходу запустить автозагрузку любых файлов
     Ты можешь увидеть что я указал в composer.json
     "app\\": "" - это я как бы сказал. app это папка в которой лежит composer.json.
     И теперь я тупо могу любой путь создавать папок типа /modules/jopa/negri/services/locations/SUPERCLASS.php
     делаю ему неймспейс namespeace app\modules\jopa\negri\services\locations;
     Потом в другом месте где мне надо его юзать я делаю либо $instance = new app\modules\jopa\negri\services\locations\SUPERCLASS()
     или что бы короче в разных местах в рамках файла где вызываю делаю вверху файла use app\modules\jopa\negri\services\locations\SUPERCLASS;
     И тогда уже можно просто $instance = new SUPERCLASS();
     Кстати можно делать псевдонимы типа use app\modules\jopa\negri\services\locations\SUPERCLASS as hihi;
     $instance = new hihi();

     Почему это удобно? Потом поймешь :) Но вообще мы очень часто юзаем сторонний код, библиотеки разные.
     Что бы не писать разную херню самим, да и часто это необходимо.
     Тогда тебе не надо заморачиваться с той библиотекой и как она там устроена, инклудить файлы итд
     Composer (менеджер зависимостей) сделает все за тебя.
     Уверен тут возникнут вопросы, да и даже если не возникнут - я полюбому еще про это словами подробнее расскажу.
     Задача сейчас перевести все свои классы на неймспейсы и отключить твой самодельный автолоадер. То есть то что елсе этого ифа удалится.
    */
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
    require_once '../autoLoader.php';
    spl_autoload_register('autoLoader');
}
?>
<?php

session_start();


$routeService = new RouteService();
$routeService->run();

//var_dump($_SESSION['product']);
//header("Location:".$_SERVER['REQUEST_URI']); // перенаправление на ту же страницу
?>