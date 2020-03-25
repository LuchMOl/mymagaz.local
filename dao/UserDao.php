<?php

class UserDao
{

    public function getUsers($email, $password)
    {
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);

            $stmt = $dbh->query('SELECT * FROM user');
            while ($data = $stmt->fetch()) {
                If ($data['email'] == $email) {
                    if ($data['password'] == $password) {
                        return $data;
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>