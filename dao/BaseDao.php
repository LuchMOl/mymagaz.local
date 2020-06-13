<?php

class BaseDao
{

    private $dbh = NULL;

    public function connection()
    {
        if ($this->dbh == NULL) {
            $dbh = new PDO('mysql:host=mymagaz.local;dbname=mymagaz', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                , \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);
        }
        return $dbh;
    }

    public function getAll($sql, $params = array(), $fetchMode = null)
    {
        //var_dump($sql);
        //$stmt = $this->connection()->query($sql);
        $stmt = $this->connection()->prepare($sql);
        if ($this->execute($stmt, $params)) {
            if ($fetchMode) {
                $result = $stmt->fetchAll($fetchMode);
            } else {
                $result = $stmt->fetchAll();
            }
            return $result;
        }
        return array();
    }

    public function getRow($sql, $params = array())
    {
        //$stmt = $this->connection()->query($sql);
        $stmt = $this->connection()->prepare($sql);
        if ($this->execute($stmt, $params)) {
            return $stmt->fetch();
        }
        return array();
    }

    public function getColumn($sql, $params = array())
    {
        $stmt = $this->connection()->query($sql);
        if ($this->execute($stmt, $params)) {
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return array();
    }

    public function getOne($sql, $params = array())
    {
        $result = false;
        $stmt = $this->connection()->prepare($sql);
        //var_dump($stmt);
        if ($this->execute($stmt, $params)) {
            $res = $stmt->fetch();
            $result = is_array($res) ? current($res) : $res;
        }
        return $result;
    }

    public function prepare($sql)
    {
        $stmt = $this->connection()->prepare($sql);
        return $stmt;
    }

    public function quote($string)
    {
        return $this->connection()->quote($string);
    }

    public function execute($sql, $params = array())
    {
        if ($sql instanceof PDOStatement) {
            $stmt = $sql;
        } else {
            $stmt = $this->connection()->prepare($sql);
        }
        $this->_lastStatement = $stmt;
        if ($stmt) {

            return $stmt->execute($params);
        }
        return false;
    }

    public function insert_ID()
    {
        return $this->connection()->lastInsertId();
    }

}

?>