<?php

function myAutoloader($className){

	$a = require '' . $className . '.php';
}
echo "$a";
spl_autoload_register('myAutoloader');
echo "$className";
?>
