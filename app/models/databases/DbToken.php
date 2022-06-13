<?php

namespace MyApp\models\databases;

use MyApp\models\interfaces\DbTokenInterface;

/**
 * DbToken
 */
class DbToken extends Dbh implements DbTokenInterface {    
    /**
     * showIdToken
     *
     * @param  string $token
     * @return int
     */
    function showIdToken(string $token):int
    {
        
        $conn =$this->connect();
        $query = "SELECT id FROM cart_name WHERE token = :token";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('token',$token,\PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
    }
    
    /**
     * generateToken
     *
     * @return string
     */
    function generateToken():string{
        return sha1(uniqid('php_',true));
    }
    }