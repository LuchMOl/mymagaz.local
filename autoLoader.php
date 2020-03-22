<?php

function autoLoader($className)
{
    if (strstr($className, 'Controller')) {
        require_once '/../controllers/' . $className . '.php';
    } elseif (strstr($className, 'Service')) {
        require_once '/../services/' . $className . '.php';
    } elseif (strstr($className, 'Dao')) {
        require_once '/../dao/' . $className . '.php';
    } elseif (strstr($className, 'Mapper')) {
        require_once '/../dao/mapper/' . $className . '.php';
    } elseif ($className === 'User') {
        require_once '/../models/' . $className . '.php';
    }
}

?>