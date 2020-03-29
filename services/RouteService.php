<?php

class RouteService
{

    private $route = [];

    private function getRoute()
    //возвращает массив из частей маршрута
    {
        echo __METHOD__ . '<br>';
        if ($this->route == NULL) {
            return $this->route = explode('/', $_SERVER['REQUEST_URI']);
        } else {
            return $this->route;
        }
    }

    public function getFirstPart()
    //возвращает первую часть маршрута
    {echo __METHOD__ . '<br>';
        return $this->getRoute()[1];
    }

    public function getSecondPart()
    //возвращает вторую часть маршрута
    {echo __METHOD__ . '<br>';
        return $this->getRoute()[2];
    }

    public function getThirdPart()
    //возвращает третью часть маршрута
    {echo __METHOD__ . '<br>';
        return $this->getRoute()[3];
    }

    public function run()
    {echo __METHOD__ . '<br>';
        $first = $this->getFirstPart();
        if ($first != NULL) {
            $className = ucfirst($first) . 'Controller';
            if ($first != NULL && !file_exists('../controllers/' . $className . '.php')) {
                StaticService::return404();
            } elseif (file_exists('../controllers/' . $className . '.php') && $this->getSecondPart() == NULL) {
                ${$first . 'Controller'} = new $className();
                ${$first . 'Controller'}->actionIndex();
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
            StaticService::renderLinks();
        }
    }

}

?>