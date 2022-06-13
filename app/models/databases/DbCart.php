<?php

namespace MyApp\models\databases;

use MyApp\models\interfaces\DbCartInterface;



/**
 * DbCart
 */
class DbCart extends Dbh implements DbCartInterface {


  
    /**
     * showAllProductInCart
     *
     * @param string $token
     * @return array
     */
    function showAllProductInCart(string $token) :array
    {   
        $conn =$this->connect();
        $query="SELECT 
                    cn.name as 'cart_name', 
                    p.name, 
                    ec.category 
                FROM 
                    cart as c LEFT JOIN cart_name as cn 
                    ON cn.id=c.cart_name_id 
                    LEFT JOIN products as p 
                    ON c.products_id = p.id 
                    LEFT JOIN enum_category as ec 
                    ON p.category_id = ec.id 
                WHERE 
                    cn.token =:token ;";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('token',$token,\PDO::PARAM_STR);
        $result = $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }    
       
    /**
     * addNewProductToCart
     *
     * @param  string $token
     * @param  int $product
     * @return void
     */
    function addNewProductToCart(string $token, int $product):void
    {
        $conn =$this->connect();
        $token_id= new DbToken;
        $id= $token_id->showIdToken($token);
        $query = "INSERT INTO cart value (:id,:product);";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('id',$id,\PDO::PARAM_INT);
        $stmt->bindValue('product',$product,\PDO::PARAM_INT);
        $stmt->execute();
    }    
    /**
     * deleteCart
     *
     * @param  string $token
     * @return void
     */
    function deleteCart(string $token) :void
    {
        $conn =$this->connect();
        $query = "DELETE FROM cart_name WHERE token=:token;";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('token',$token,\PDO::PARAM_STR);
        $stmt->execute();
    }    
    /**
     * editNameCart
     *
     * @param  string $token
     * @param  string $newCartName
     * @return void
     */
    function editNameCart(string $token, string $newCartName):void
    {
        $conn =$this->connect();
        $query="UPDATE cart_name
                SET name = :newCartName
                WHERE token=:token;";
        
        $stmt = $conn->prepare($query);
        $stmt->bindValue('token',$token,\PDO::PARAM_STR);
        $stmt->bindValue('newCartName',$newCartName,\PDO::PARAM_STR);
        $stmt->execute();
    }


    }