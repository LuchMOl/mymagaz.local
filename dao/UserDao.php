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

            foreach ($dbh->query('SELECT * from user') as $users) {

                //var_dump($users);
                return $users;
            }

            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>