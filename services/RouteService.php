<?php

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
        return $this->getRoute()[1];
    }

    public function getSecondPart()
    {
        return $this->getRoute()[2];
    }

    public function getThirdPart()
    {
        return $this->getRoute()[3];
    }

    public function run()
    {
        $first = $this->getFirstPart();
        if ($first != NULL) {
            $className = ucfirst($first) . 'Controller';
            if ($first != NULL && !file_exists('../controllers/' . $className . '.php')) {
                StaticService::return404();
            } elseif (file_exists('../controllers/' . $className . '.php') AND $this->getSecondPart() == NULL) {
                ${$first . 'Controller'} = new $className();
                ${$first . 'Controller'}->actionIndex();
            } elseif (is_numeric($this->getSecondPart())) {
                ${$first . 'Controller'} = new $className();
                ${$first . 'Controller'}->actionViewProducts($this->getSecondPart());
            } else {
                ${$first . 'Controller'} = new $className();
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
