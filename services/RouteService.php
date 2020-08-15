<?php

namespace app\services;

use app\controllers\AdminController;
use app\controllers\ProductController;

class RouteService
{

    private $route = [];

    private function getRoute()
    {
        if ($this->route == NULL) {
            return $this->route = explode('/', $_SERVER['REQUEST_URI']);
        } else {
            return $this->route;
        }
    }

    public function getFirstPart()
    {
        if (isset($this->getRoute()[1])) {
            return $this->getRoute()[1];
        }
    }

    public function getSecondPart()
    {
        if (isset($this->getRoute()[2])) {
            return $this->getRoute()[2];
        }
    }

    public function getThirdPart()
    {
        if (isset($this->getRoute()[3])) {
            return $this->getRoute()[3];
        }
    }

    public function run()
    {
        $first = $this->getFirstPart();
        if ($first != NULL) {
            $className = ucfirst($first) . 'Controller';
            $useClassName = 'app\controllers\\' . ucfirst($first) . 'Controller';
            if ($first != NULL && !file_exists('../controllers/' . $className . '.php')) {
                StaticService::return404();
            } elseif (file_exists('../controllers/' . $className . '.php') && $this->getSecondPart() == NULL) {
                ${$first . 'Controller'} = new $useClassName();
                ${$first . 'Controller'}->actionIndex();
            } elseif (is_numeric($this->getSecondPart())) {
                ${$first . 'Controller'} = new $useClassName();
                ${$first . 'Controller'}->actionViewProducts($this->getSecondPart());
            } else {
                ${$first . 'Controller'} = new $useClassName();
                $second = $this->getSecondPart();
                $methodName = "action" . ucfirst($second);
                if (!method_exists(${$first . 'Controller'}, $methodName)) {
                    StaticService::return404();
                } elseif ($this->getThirdPart() !== NULL) {
                    ${$first . 'Controller'}->$methodName($this->getThirdPart());
                }
            }
        } else {
            require_once "magaz.php";
        }
    }

}
