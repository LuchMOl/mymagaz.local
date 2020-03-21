<?php

class RouteService
{

    private $route = [];

    private function getRoute()
    //возвращает массив из частей маршрута
    {
        if ($this->route == NULL) {
            return $this->route = explode('/', $_SERVER['REQUEST_URI']);
        } else {
            return $this->route;
        }
    }

    public function getFirstPart()
    //возвращает первую часть маршрута
    {
        return $this->getRoute()[1];
    }

    public function getSecondPart()
    //возвращает вторую часть маршрута
    {
        return $this->getRoute()[2];
    }

    public function getThirdPart()
    //возвращает третью часть маршрута
    {
        return $this->getRoute()[3];
    }

    public function run()
    {
        $first = $this->getFirstPart();
        $className = ucfirst($first) . 'Controller';

        if (file_exists('../controllers/' . $className . '.php')) {

            ${$first . 'Controller'} = new $className();

            $second = $this->getSecondPart();
            $methodName = "action" . ucfirst($second);
            if (method_exists(${$first . 'Controller'}, $methodName)) {

                ${$first . 'Controller'}->$methodName($this->getThirdPart());
            } elseif ($second != NULL) {
                echo 'Method ' . $methodName . ' in objeck ' . $className . ' not exist!';
            } else {
                ${$first . 'Controller'}->actionIndex();
            }
        } elseif ($first != NULL) {
            echo $className . ' not exist!';
        }//else отсутствие чего либо после mymagaz.local/
    }

}
?>