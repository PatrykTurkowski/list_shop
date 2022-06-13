<?php

namespace MyApp\models\classes;

use MyApp\models\databases\DbProducts;

class Product extends DbProducts{

    public $name;
    public $type;

    
    /**
     * __construct
     *
     * @param  string $name
     * @param  int $type
     * @return void
     */
    function __construct(string $name,int $type)
    {
        $this->name = $name;
        $this->type = $type;
    }


    /**
     * dbAddNewProducts
     *
     * @return void
     */
    function addNewProducts():void
    {
        $this->dbAddNewProducts($this->name,$this->type);
    }
}