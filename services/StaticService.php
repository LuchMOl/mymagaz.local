<?php

class StaticService
{

    static function getFilesNames($dir)
    {
        return scandir($dir);
    }

    static function return404()
    {
        //header("HTTP/1.0 404 Not Found");
        echo "<div class='new-arrivals-content'><div class='tank'>";
        echo file_get_contents('../404.php');
        echo "</div></div>";
        //die();
    }

    static function renderLinks()
    {
        echo "<a href = 'http://mymagaz.local/'>mymagaz.local</a>\t-\t";
        echo "<a href = 'http://mymagaz.local/task/'>task</a>\t-\t";
        echo "<a href = 'http://mymagaz.local/user/'>user</a>\t-\t";
        echo "<a href = 'http://mymagaz.local/product/'>product</a><br>";
    }

}
