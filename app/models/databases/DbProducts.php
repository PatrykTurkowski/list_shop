<?php

namespace MyApp\models\databases;

use MyApp\models\interfaces\DbProductsInterface;

/**
 * DbProducts
 */
class DbProducts extends Dbh implements DbProductsInterface  {
  
    /**
     * dbShowAllProducts
     *
     * @return array
     */
    function dbShowAllProducts():array
    {
        $conn =$this->connect();
        $query="SELECT * FROM products";
        $stmt = $conn->prepare($query);
        return $stmt->execute();
        
    }    
    /**
     * dbAddNewProducts
     *
     * @param string $name
     * @param int $type
     * @return void
     */
    function dbAddNewProducts(string $name, int $type):void
    {
        $conn =$this->connect();
        $query="INSERT INTO products 
                VALUES
                (null,:name,:type)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('name',$name,\PDO::PARAM_STR);
        $stmt->bindValue('type',$type,\PDO::PARAM_INT);
        $stmt->execute();

        
    }
        
    /**
     * dbDeleteProducts
     *
     * @param  int $product_id
     * @return void
     */
    function dbDeleteProducts(int $product_id):void
    {
        
        $conn =$this->connect();
        $query = "DELETE FROM products WHERE id=:product_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('product_id',$product_id,\PDO::PARAM_INT);
        $stmt->execute();
    }    
    /**
     * dbEditProducts
     *
     * @param  int $product_id
     * @param  string $name
     * @return void
     */
    function dbEditProducts(int $product_id, string $name):void
    {
        $conn =$this->connect();
        $query = "UPDATE products SET name= WHERE id=:product_id;";
        $stmt = $conn->prepare($query);
        $stmt->bindValue('product_id',$product_id,\PDO::PARAM_INT);
        $stmt->execute();
    }
       
    /**
     * dbType
     *
     * @return array
     */
    function dbType():array
    {
        $conn =$this->connect();
        $query="SELECT * FROM enum_category";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    }