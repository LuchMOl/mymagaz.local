<?php

namespace app\dao;

class UserDao extends BaseDao
{

    public function getUser($email, $password)
    {
        $sql = "SELECT u.id, u.email, u.password, u.name, u.currency_id as currencyId, s.session_id as sessionId "
                . "FROM users u "
                . "INNER JOIN session_user s "
                . "ON u.id = s.user_id "
                . "WHERE u.email = :email AND u.password = :password";
        $params = ['email' => $email, 'password' => $password];
        $user = $this->getRow($sql, $params);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * "
                . "FROM users "
                . "WHERE email = :email";
        $params = ['email' => $email];
        return $this->getRow($sql, $params);
    }

    public function insertUser($user)
    {
        $sql = "INSERT INTO users (email, name, password, currency_id) "
                . "VALUES (:email, :name, :password, :currency_id)";
        $params = ['email' => $user->email,
            'name' => $user->name,
            'password' => $user->password,
            'currency_id' => $user->getCurrencyId()];
        $write = $this->execute($sql, $params);
        $lastInsertId = $write ? $this->insert_ID() : false;
        $user->id = $lastInsertId;
        return $this->insertSesId($user);
    }

    public function insertSesId($user)
    {
        $sql = "INSERT INTO session_user (user_id, session_id)"
                . "VALUES (:user_id, :session_id)";
        $params = ['user_id' => $user->id, 'session_id' => $user->sessionId];
        return $this->execute($sql, $params);
    }

    public function getUserBySesId($sessionId)
    {
        $sql = "SELECT u.id, u.email, u.password, u.name, s.session_id as sessionId, u.currency_id as currencyId"
                . "FROM users u "
                . "INNER JOIN session_user s "
                . "ON u.id = s.user_id "
                . "WHERE s.session_id = :session_id";
        $params = ['session_id' => $sessionId];
        $user = $this->getRow($sql, $params);
        return $user;
    }

    public function byDefaultCurrencyForUser($user, $currencyId)
    {
        $sql = "UPDATE users SET currency_id = :currency_id WHERE id = :id";
        $params = ['currency_id' => $currencyId, 'id' => $user->getId()];
        $this->execute($sql, $params);
    }

}
