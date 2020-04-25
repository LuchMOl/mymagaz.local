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
            return $dbh;
        } else {
            return $dbh;
        }
    }

    public function GetAll($sql, $params = array(), $fetchMode = null)
    {
        //$stmt = $this->connection()->query($sql);
        $stmt = $this->connection()->prepare($sql);
        if ($this->Execute($stmt, $params)) {
            if ($fetchMode) {
                $result = $stmt->fetchAll($fetchMode);
            } else {
                $result = $stmt->fetchAll();
            }
            return $result;
        }
        return array();
    }

    public function GetRow($sql, $params = array())
    {
        //$stmt = $this->connection()->query($sql);
        $stmt = $this->connection()->prepare($sql);
        if ($this->Execute($stmt, $params)) {
            return $stmt->fetch();
        }
        return array();
    }

    public function GetOne($sql, $params = array())
    {
        $result = false;
        $stmt = $this->connection()->prepare($sql);

        if ($this->Execute($stmt, $params)) {
            $res = $stmt->fetch();
            $result = is_array($res) ? current($res) : $res;
        }
        return $result;
    }

    public function Prepare($sql)
    {
        $stmt = $this->connection()->prepare($sql);
        return $stmt;
    }

    public function quote($string)
    {
        return $this->connection()->quote($string);
    }

    public function Execute($sql, $params = array())
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

    public function Insert_ID()
    {
        return $this->connection()->lastInsertId();
    }

}

?>