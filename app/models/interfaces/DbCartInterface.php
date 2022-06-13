<?php

namespace MyApp\models\interfaces;


interface DbCartInterface{
    
    function showAllProductInCart(string $token):array;
    function addNewProductToCart(string $token,int $product):void;
    function deleteCart(string $token) :void;
    function editNameCart(string $token, string $newName) :void;
}