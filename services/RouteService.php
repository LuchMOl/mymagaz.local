<?php

class RouteService
{
	var $route;
	var $pieces;

		function getFirstPart()
		{
			$route = $_SERVER['REQUEST_URI'];
			$pieces = explode('/', $_SERVER['REQUEST_URI']);

			return $pieces[1];
		}

		function getSecondPart()
		{
			$route = $_SERVER['REQUEST_URI'];
			$pieces = explode('/', $_SERVER['REQUEST_URI']);

			return $pieces[2];

		}

		function getThirdPart()
		{
			$route = $_SERVER['REQUEST_URI'];
			$pieces = explode('/', $_SERVER['REQUEST_URI']);

			return $pieces[3];

		}

}

?>