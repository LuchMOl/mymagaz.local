<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<a href="../"><h1>MyMagaz</h1></a></br>
	<a href="../"><h2>Back</h2></a>

<h1>Tasks</h1>

	<h2>№1</h2>

		<a href="../img/task_1.jpg" target= "_blank"><img src="../img/task_1.jpg" width="170"></a>

	<h2>№2</h2>

		<a href="../img/task_2.jpg" target= "_blank"><img src="../img/task_2.jpg" width="170"></a></br>

	<h2>№3 Последующие действия</h2>

		<p>Нам необходима модель представляющая пользователя. В папке models создаем файл user.php. В нем описываем класс User. Два поля имя и имейл. А так же методы дотсупа и установки этих полей. Создаем ему простанство имен (namespace) app\modesl</p>
        <p> Дальше в index.php мы должны зарегестрировать автолоадер. И создать обьект нашего пользоваетя $user = new User; Это должно отработать. Вверху не забудем указать use app\models\User;</p>
        <p> Затем делаем $user->setName(), $user->setEmail(). И выводим print($user->getName()); и мыло так же.</p>
        <p> Статья в помощь https://ruseller.com/lessons.php?rub_id=37&id=1178</p>





</body>
</html>

