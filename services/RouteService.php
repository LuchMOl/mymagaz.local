<?php

class RouteService
{

    private function getRoute()
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    function getFirstPart()
    {
        return $this->getRoute()[1];
    }

    function getSecondPart()
    {
        return $this->getRoute()[2];
    }

    function getThirdPart()
    {
        return $this->getRoute()[3];
    }

}
?>