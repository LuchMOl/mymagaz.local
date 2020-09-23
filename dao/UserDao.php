<?php

namespace app\dao;

class UserDao extends BaseDao
{

    public function getUser($email, $password)
    {
        $sql = "SELECT u.id, u.email, u.password, u.name, s.session_id as sessionId "
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
        $sql = "INSERT INTO users (email, name, password) "
                . "VALUES (:email, :name, :password)";
        $params = ['email' => $user->email, 'name' => $user->name, 'password' => $user->password];
        $write = $this->execute($sql, $params);
        $lastInsertId = $write ? $this->insert_ID() : false;
        $user->id = $lastInsertId;
        return $this->setSesId($user);
    }

    public function getOrder($user)
    {
        $sql = "SELECT product_id as productId, color_id as colorId, size_id as sizeId, quantity "
                . "FROM cart "
                . "WHERE user_id = $user->id";
        $order = $this->getAll($sql);
        return $order;
    }

    public function setSesId($user)
    {
        $sql = "INSERT INTO session_user (user_id, session_id)"
                . "VALUES (:user_id, :session_id)";
        $params = ['user_id' => $user->id, 'session_id' => $user->sessionId];
        return $this->execute($sql, $params);
    }

    public function getUserBySesId($sessionId)
    {
        $sql = "SELECT u.id, u.email, u.password, u.name, s.session_id as sessionId "
                . "FROM users u "
                . "INNER JOIN session_user s "
                . "ON u.id = s.user_id "
                . "WHERE s.session_id = :session_id";
        $params = ['session_id' => $sessionId];
        $user = $this->getRow($sql, $params);
        return $user;
    }

}
