<?php

namespace MyApp\models\interfaces;


interface DbTokenInterface{
   
    function showIdToken(string $token) :int;
    function generateToken() :string;
}
