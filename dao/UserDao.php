<?php

class UserDao
{

    public function getUser($email, $password)
    {
        echo __METHOD__ . '<br>';
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);

            $row = $dbh->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            return $row->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>