Хорошо, в целом очень хорошо, даже лучше чем я ожидал :).<br>
1. Нужно проставить public для публичных методов в RouteService. Проставляем всегда и переменным и методам их видимость. Пустое никогда не бывает (так принято).
<br>2. Давай представим что в getRoute происходит что-то сложное, какое-то чтение файла, или тяжелый запрос в базу данных.
Когда мы вызываем getFirstPart, getSecondPart итд. у нас каждый раз внутри будет вызываться getRoute (так и должно быть, это ок), но вот зачем нам каждый раз решать задачу которую решает getRoute если результат всегда один?
<p><font color = 'red'>
А он ВСЕГДА один? Маршрут ведь меняется. Как я понимаю, нужно проверять изменился ли маршрут после предыдущего вызова getRoute, и если нет - просто вернуть старое значение, а если изменился - отработать и вернуть новое?
Тоесть если марштут состоит из 100 кусков и мы докапываемся до сотого нет смысла каждый раз розбивать заново маршрут на части т.к. строка маршрута не изменилась.
<p><font color = 'black'>
Нужно решить эту проблему. Попробуй сначала сам подумать. Я дам несколько подсказок: а) нам понадобиться переменная в классе. б) посмотри на паттерн сингльтон https://refactoring.guru/ru/design-patterns/singleton/php/example , он вообще для того что бы вроде как создавать класс только единожды, но его реализация и нам подходит.

3. Хорошо что ты пошел по пути какой-то универсиализации наших тасков, и оно теперь более красиво и структурировано. Но давай как-то еще упростим эту задачу.
Напряжно каждый раз дописывать 5,6,7,8 итд.
<pre>
if (\$routeService->getSecondPart() === '5') {
            \$task->taskFour();
        }
</pre>
Это первый момент. А второй момент не принято хранить огромные куски текста и особенно html непосредственно в классе в методах. Гораздо правильнее что бы таски у нас хранились в отедльном месте.

И так глобальная задача звучит так. Я хочу что бы я мог во views/tasks/ создать любой файл и он автоматически отображался у нас в индексе, и я мог оттуда их открывать.
Вот как сейчас, мы жмем на раздел tasks и у нас появляются ссылки 1,2,3,4. Вместо них должны появляться ссылки на файлы из указанного каталога.

Tasks.php переносим в services и неймим его соответсвенно как службу ТаскСервис.

Папака views у нас не будет содержать классов. В ней всегда будет находится только то что мы отображаем непосредственно на экране.
(можно краем глаза почитать про MVC https://ruseller.com/lessons.php?id=666 -> вид)

Ознакамливаемся с циклами. for, foreach.

Ищем функцию что бы выгребать все файлы из каталога.

В наш такссервися, в метод getTask мы будем передвать то что нам отдает \$routeService->getSecondPart(), и наш гет таск исходя из этого отдает нам содержимое соответствующего файла (можно рекваерить файл, я делал в одном из пред.комитов).

Если я вдруг не по ссылке с сайта буду прееходить а пропишу что-то сам, то нужно учесть есть ли такой файл (file_exists) и писать 'ОШИБКА. ТАКОГО ЗАДАНИЯ НЕТ.'

Ps. ну и понятно дело наши текущие таски убираем с task.php и переводим на новую систему.