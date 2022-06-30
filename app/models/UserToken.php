<?php

require_once '../app/databases/DbUserToken.php';
class UserToken extends Database
{
    // public $db;
    // public $dbProd;
    // public $token;
    // public $name;
    public function __construct()
    {
        $this->db = new DbUserToken;
    }


    public function create(): void
    {
        $this->db->createIndividualList();
    }
    public function list(): array
    {
        return $this->db->yourIndividualList();
    }
}
