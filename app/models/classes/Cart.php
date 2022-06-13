<?php

namespace MyApp\models\classes;

use MyApp\models\databases\DbCart;

class Cart extends DbCart{

       public string $token;
       
       /**
        * __construct
        *
        * @param  string $token
        * @return void
        */
       function __construct(string $token)
       {
        $this->token=$token;
       }

       /**
     * showAllProductInCart
     *
     * @param string $token
     * @return array
     */
    function show() :array
    {   
        
        return $this->showAllProductInCart($this->token);
    }    

}