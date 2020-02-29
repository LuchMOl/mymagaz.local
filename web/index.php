
<p>
    <a href="/"><h2>mymagaz.local</h2></a>
</p>
<p>
    <a href="/tasks"><h2>tasks</h2></a>
</p>
<p>
    <a href="/testhello/dima"><h2>/testhello/dima</h2></a>
</p>
<p>
    <a href="/testhello/dima/33"><h2>/testhello/dima/33</h2></a>
</p>

<?php

include '../app/services/routeservice.php';

//$home = "mymagaz.local";

$routeService = new RouteService();

echo "<p></p>";

var_dump($routeService);

?>