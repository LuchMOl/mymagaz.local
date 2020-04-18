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
    public function disConnection(){
        
    }

}
?>