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

}
?>