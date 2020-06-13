<?php

class UserDao extends BaseDao
{

    private $tables = 'test';
    //private $tables = 'users';
    private $sid_tables = 'session_user_test';
    //private $sid_tables = 'session_user';

    public function getUser($email, $password)
    {
        $sql = "SELECT t.id, t.email, t.password, t.name, s.session_id "
                . "FROM $this->tables t INNER JOIN $this->sid_tables s "
                . "ON t.id = s.user_id "
                . "WHERE t.email = :email AND t.password = :password";
        $params = ['email' => $email, 'password' => $password];
        return $this->getRow($sql, $params);
    }

    public function getSIdUser($sessionId)
    {
        $sql = "SELECT t.id, t.email, t.password, t.name, s.session_id "
                . "FROM $this->tables t INNER JOIN $this->sid_tables s "
                . "ON t.id = s.user_id "
                . "WHERE  s.session_id = :session_id";
        $params = ['session_id' => $sessionId];
        return $this->getRow($sql, $params);
    }

    public function checkUser($email)
    {
        $sql = "SELECT * FROM $this->tables "
                . "WHERE email = :email";
        $params = ['email' => $email];
        return $this->getOne($sql, $params);
    }

    public function setUser($email, $name, $password)
    {
        $sql = "INSERT INTO $this->tables (email, name, password) "
                . "VALUES (:email, :name, :password)";
        $params = ['email' => $email, 'name' => $name, 'password' => $password];
        $this->execute($sql, $params);
        $id = $this->getOne("SELECT MAX(id) AS id FROM $this->tables");
        $this->setSId($id);
        return $id;
    }

    public function setSId($id)
    {
        $sql = "INSERT INTO $this->sid_tables (user_id, session_id)"
                . "VALUES (:user_id, :session_id)";
        $sId = session_id();
        $params = ['user_id' => $id, 'session_id' => $sId];
        $this->execute($sql, $params);
    }
}
