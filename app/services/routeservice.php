<?php

class RouteService
{
	public $first;
	public $second;
	public $third;
	public $route;
	public $countSlash;
	public $ro = array();


		public function __construct()
		{
			$route = $_SERVER['REQUEST_URI'];													echo "$route<br>";
			$countSlash = substr_count($route, '/');											echo "$countSlash<br>";

			if ($countSlash === 3)
				{
				preg_match('/[\/](.*)\/(.*)\/(.*)/', $route, $ro);
print_r ($ro);
				return $first = $ro[1];
				return $second = $ro[2];
				return $third = $ro[3];
				}
				elseif ($countSlash === 2)
					{
					preg_match('/[\/](.*)\/(.*)/', $route, $ro);
print_r ($ro);
					return $first = $ro[1];
					return $second = $ro[2];
					}

				elseif ($countSlash === 1)
					{

					preg_match('/[\/](.*)/', $route, $ro);
print_r ($ro);
						if (strlen($ro[1]) <> 0)
						{
							return $first = $ro[1];
							echo "$first";
						}else{

							//если только домен
						}
					}
		}
}

?>