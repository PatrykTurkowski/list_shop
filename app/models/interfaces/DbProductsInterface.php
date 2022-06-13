<?php

namespace MyApp\models\interfaces;


interface DbProductsInterface{

    function dbShowAllProducts():array;
    function dbAddNewProducts(string $name, int $type):void;
    function dbDeleteProducts(int $product_id):void;
    function dbEditProducts(int $product_id, string $name):void;
    function dbType():array;
}