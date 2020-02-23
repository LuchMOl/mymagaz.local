<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href=""><h1>MyMagaz</h1></a></br>
<a href="tasks.php"><h2>Tasks</h2></a><br>
<p></p>

<?php

	$user = new user;
	$user->UserName = "admin";
	$user->UserEmail = "admin@mymagaz.local";

	//print_r($user);
	//print_r($_POST);
	//echo get_class($user);

require '../models/user.php';

?>

</body>
</html>


