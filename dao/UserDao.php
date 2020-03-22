<?php

class UserDao
{

    public function getUsers()
    {
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root');

            foreach ($dbh->query('SELECT * from user') as $users) {

                return $users;
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>