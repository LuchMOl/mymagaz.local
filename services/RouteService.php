<?php

class RouteService
{

    private $route = array(0);

    private function getRoute()
    {
        if ($this->route !== explode('/', $_SERVER['REQUEST_URI'])) {
            return $route = explode('/', $_SERVER['REQUEST_URI']);
        } else {
            return $route;
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

}
?>