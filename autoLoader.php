<?php

function autoLoader($className)
{
    if (strstr($className, 'Controller')) {
        require_once '/../controllers/' . $className . '.php';
    } elseif (strstr($className, 'Service')) {
        require_once '/../services/' . $className . '.php';
    } elseif (strstr($className, 'Dao')) {
        require_once '/../Dao/' . $className . '.php';
    }
}

?>