
<p>
    <a href="http://mymagaz.local"><h2>mymagaz.local</h2></a>

    <a href="http://mymagaz.local/tasks"><h2>tasks</h2></a>
</p>
<p>
    <a href="/testhello/dima"><h2>/testhello/dima</h2></a>
</p>

<?php

$home = "mymagaz.local";

$link = $_SERVER['REQUEST_URI'];

$arr_str = preg_match_all("/([a-zA-z0-9]+)/", $_SERVER['REQUEST_URI'], $rez);
//print_r ($rez[0][0]);
//print_r ($rez[0][1]);

if ($rez[0][0] === "testhello") {

    echo "<h1>It is a {$rez[0][0]}.</h1>";
    echo "Hello, {$rez[0][1]}!";
}


if ($link === "/") {
    echo "<h1>$home</h1>";
}


if ($link === "/tasks") {

    require_once '../views/tasks/tasks.php';
}
?>