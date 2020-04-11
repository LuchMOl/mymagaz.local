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

//echo /ImageService::getImgTag('1');
//echo /ImageService::getImgTag('1', '100px');
//echo /ImageService::getImgTag('1', '.png');
//echo /ImageService::getImgTag('3211');
//echo /ImageService::getImgTag('1', '.jpg');
//echo /ImageService::getImgTag('1', '.png', '100px', '300px');
?>

<?php require_once 'header.php'; ?>


<?php
$routeService = new RouteService();
$routeService->run();
?>



<?php require_once 'footer.php'; ?>