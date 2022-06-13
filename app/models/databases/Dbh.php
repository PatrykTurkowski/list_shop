<?php

namespace MyApp\models\databases;

/**
 * Dbh
 */
class Dbh {    
    /**
     * db_host
     *
     * @var string
     */
    private $db_host = 'localhost';
    private $db_name = 'list_products';
    private $db_username ='root';
    private $db_password ='';
    
    /**
     * connect
     *
     * @return PDO
     */
    public function connect() :\PDO {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
        $db_connection =new \PDO($dsn,$this->db_username,$this->db_password);
        $db_connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $db_connection;         
    }

}





