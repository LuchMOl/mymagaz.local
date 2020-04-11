<?php

class UserDao
{

    public function getUser($email, $password)
    {
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

    public function checkUser($email, $name)
    {
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);

            $row = $dbh->query("SELECT * FROM user WHERE email = '$email' OR name = '$name'");
            return $row->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setUser($email, $name, $password)
    {
        try {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);

            $id = $dbh->query("SELECT COUNT('id') as count FROM user")->fetchColumn();

            $sql = "INSERT INTO user (id, email, name, password) VALUES ('$id', '$email', '$name', '$password')";

            $dbh->exec($sql);
            echo '<script>
                location.href= "/";
                </script>';
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

}

?>
