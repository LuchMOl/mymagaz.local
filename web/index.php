<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<p>
    Я включил ошибки все что бы показывало. Сейчас еще прокомментирую.
    <img src="/img/1.png" height="400"><br>
    1. tasks у тебя не строка.
    2. Это не ошибка, но используй как неравно !=. Так удобнее читать, и более принято.
<h3>Почитать про Типы данных (переменных) в PHP, например http://www.php.su/learnphp/vars/?types . То есть строки у нас всегда в кавычках.</h3>
Дальше про наш роутсервис. Мне в целом он ок. Только ты создал в нем две переменных и их не ипользуешь (зачем тогда создавал)? Можешь их пока убрать. Мы к созданию полей (переменных) класса еще вернемся через один этап.
<br>Сейчас что бы уменьшить количество механических ошибок и опечаток, нужно перейти на среду для разработки. IDE в народе.
<br>Мы будем юзать netbeans. Сейчас задача установить его и открыть проэкт.
<br>
1. Качаем https://netbeans.apache.org/download/nb112/nb112.html<br>
2. Ставим.<br>
3. Заходишь в tools -> options внизу слева import и импоритуешь настройки с архива что я тебе в телегу кинул. <br>
4. Дальше надо создать проект. file, new project, php, php application with existed sources, <br>
source folder - путь к корню нашего проекта,name - mymagaz.local, php verson 5.6, utf-8, finish
<br>
В дальнейшем пользовать только его. Из полезных клавишь alt + shift + f - форматирование текста. Ctrl+shift+ вниз/вверх скопировтаь строку. ctrl + alt + вниз/вверх - переместить строку.
Есть еще, но пока тебе рано знать их.
<br>
Дальше. Мне не нравится что у тебя в трех методах один и тот же код. <img src="/img/2.png" height="400"><br>
В случае когда надо изменить логику определения (например не эксплод, а регуляркой), тебе придется менять это в трех местах (в этих трех методах). Это не ок.
<br>
Вынеси одинаковый код в отдельный метод. Можешь заодно использовать переменные которые висят без толку сейчас. У тебя остануться все методы которые сейчас есть, добавиться еще только один и изменится содержимое твоих троих.
<br> Давай накинем еще инфы. Сставь публичными только три метода которые есть сейчас, остальное я не должен иметь доступ из индекса. Ознакомся с материалом https://www.php.net/manual/ru/language.oop5.visibility.php 

</p>
<p>
    <a href="/"><h2>mymagaz.local</h2></a>
</p>
<p>
    <a href="/tasks"><h2>tasks</h2></a>
</p>

<?php

include '../services/RouteService.php';

$routeService = new RouteService();

if ($routeService->getFirstPart() === tasks) {
    include '../views/tasks/tasks.php';
}

if ($routeService->getFirstPart() <> NULL) {
    $first = $routeService->getFirstPart();
    echo "1.$first. ";
    if ($routeService->getSecondPart() <> NULL) {
        $Second = $routeService->getSecondPart();
        echo "2.$Second. ";
        if ($routeService->getThirdPart() <> NULL) {
            $Third = $routeService->getThirdPart();
            echo "3.$Third. ";
        }
    }
}
?>