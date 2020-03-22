<?php

class UserDao
{

    public function getUsers()
    {
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);
            $query = $dbh->prepare("SELECT * FROM user");
            $query->execute(array());
            return $query->fetchAll();

            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>