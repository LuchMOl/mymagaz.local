<?php

function autoLoader($className)
{
    if (strstr($className, 'Controller')) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../controllers/' . $className . '.php';
    } elseif (strstr($className, 'Service')) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../services/' . $className . '.php';
    } elseif (strstr($className, 'Dao')) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../dao/' . $className . '.php';
    } elseif (strstr($className, 'Mapper')) {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../dao/mapper/' . $className . '.php';
    } elseif ($className === 'User' OR 'Category' OR 'Product') {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../models/' . $className . '.php';
    }
}
