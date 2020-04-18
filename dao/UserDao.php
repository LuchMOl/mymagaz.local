<?php

class UserDao extends BaseDao
{

    public function getUser($email, $password)
    {
        try {

            $dbh = parent::connection();

            $row = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

            return $row->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkUser($email, $name)
    {
        try {
            $dbh = parent::connection();

            $row = $dbh->query("SELECT * FROM users WHERE email = '$email' OR name = '$name'");
            return $row->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setUser($email, $name, $password)
    {
        try {
            $dbh = parent::connection();

            $sql = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')";

            $dbh->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>
