<?php

class UserDao extends BaseDao
{

    private $tables = 'users';

    public function getUser($email, $password)
    {
        return $this->GetRow("SELECT * FROM $this->tables WHERE email = '$email' AND password = '$password'");
    }

    public function checkUser($email)
    {
        return $this->GetOne("SELECT * FROM $this->tables WHERE email = '$email'");
    }

    public function setUser($email, $name, $password)
    {
        $this->Execute("INSERT INTO $this->tables (email, name, password) VALUES ('$email', '$name', '$password')");
    }

}

?>