<! -- errors -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<! -- includs -->
<?php
require_once '../autoLoader.php';
spl_autoload_register('autoLoader');
?>

<a href='http://mymagaz.local/'><br>mymagaz.local</a>
<a href='http://mymagaz.local/task/'><br><br>tasks</a>
<a href='http://mymagaz.local/user/'><span style="margin-left: 50px">users</span></a>
<a href='http://mymagaz.local/product/'><span style="margin-left: 50px">product</span><br><br></a>

<! -- task 5 -->
<?php
//echo ImageService::getImgTag('1');
//echo ImageService::getImgTag('1', '100px');
//echo ImageService::getImgTag('1', '.png');
//echo ImageService::getImgTag('3211');
//echo ImageService::getImgTag('1', '.jpg');
//echo ImageService::getImgTag('1', '.png', '100px', '300px');
?>

<! -- task 6 -->
<?php
$routeService = new RouteService();
$routeService->run();
?>