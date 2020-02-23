﻿<!DOCTYPE html>
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

		<p>В первую очередь нужно сделать авторизацию. Для этого нам необходима модель представляющая пользователя.</p>
		<p>Заодно для порядка в проекте, нужно сразу задавать правильную структуру размещения файлов. Мы будем использовать то что называется MVC паттерн.</p>
		<p>Пром mvc можно почитать <a href="https://ruseller.com/lessons.php?id=666">тут например</a>. Нас интересует раздел model сейчас. Моежшь только его понять на сейчас. К этой статье мы еще вернемся скоро.</p>
		<p>Обрати еще внимание на место в статье <i>Ваше рабочее пространство (директория app) имеет следующую структуру</i>. У нас будут местами другие имена, но в целом что-то такое же.</p>
		<h3>Пракитическое</h3>
		<ul>
		    <li>Создаем в нашем проекте папку web</li>
		    <li>Создаем в нашем проекте папку models</li>
		    <li>index.php переносим в web (потом как-то расскажу зачем это делают)</li>
		    <li>Создать модель User (в папке models)</li>
		    <li>Пока делаем поля имя, почта</li>
		    <li>В индексе создать экземпляр (обьект) Пользователя, поставить ему имя через метод, затем через метод получить имя и вывести его на экран.</li>
		</ul>
		<p>Модель представляется в программировании КЛАССОМ. Читаем что такое класс, его поля, методы.</p>
		<p>Читаем что такое простанство имен (namespace)</p>
		<h3>Опциональное задание, если хочется хардкора</h3>
		<p>Узнать про автозагрузчик классов (spl_autoload_register)</p>
		<p>Создать файл в корне autoloader.php</p>
		<p>В index.php может быть только один инклуд этого файла</p>
		<p>То есть в результате у тебя в индексе будет инклуд автолоадера. Дальше use наш класс пользователя. И создаешь обьект без инклуда файла пользователя в индексе.</p>
		<p>Результат должен быть тот же. Мы выводим имя (которое сами предаварительно задали) пользователя через метод</p>



</body>
</html>

