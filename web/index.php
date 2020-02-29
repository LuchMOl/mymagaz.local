
<p>
    <a href="/"><h2>mymagaz.local</h2></a>
</p>
<p>
    <a href="/tasks"><h2>tasks</h2></a>
</p>

<?php

include '../services/RouteService.php';

$routeService = new RouteService();

if ($routeService->getFirstPart() === tasks)
{
	include '../views/tasks/tasks.php';
}

if ($routeService->getFirstPart() <> NULL)
{
	$first = $routeService->getFirstPart();
	echo "1.$first. ";
	if ($routeService->getSecondPart() <> NULL)
	{
		$Second = $routeService->getSecondPart();
		echo "2.$Second. ";
		if ($routeService->getThirdPart() <> NULL)
		{
			$Third = $routeService->getThirdPart();
			echo "3.$Third. ";
		}
	}
}

?>