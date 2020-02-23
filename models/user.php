<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method= "post">
		<input type="text" name="Name" placeholder="Name">
		<input type="text" name="Email" placeholder="Email">
		<input type="submit" value="OK">
	</form><br>

<?php

		if (!empty($_POST)){

				if ($_POST['Name'] == $user->UserName){

					if ($_POST['Email'] == $user->UserEmail){
					echo "Welcomе, $user->UserName!";
					}else echo "Incorrect Email for ($_POST[Name]): $_POST[Email]";
				}
				else echo "Incorrect Name: $_POST[Name]";

		}else echo "Enter the Login";

?>

</body>
</html>