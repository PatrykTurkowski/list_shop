<?php

require_once '../app/databases/DbUserTokenInterface.php';
/**
 * DbUserToken
 */
class DbUserToken extends Database implements DbUserTokenInterface
{


    function __construct()
    {
        parent::__construct();
    }

    /**
     * createIndividualList - create personal cookie for user
     *
     * @return void
     */
    public function createIndividualList(): void
    {
        if (!isset($_COOKIE['id'])) {
            $token = sha1(uniqid('php_', true));
            setcookie('id', $token, time() + (86400 * 720), "/");


            $query = "INSERT INTO users (`token`)
                      VALUES(:token)";
            $this->query($query);
            $this->bind(':token', $token);
            $this->execute();
        }
    }

    /**
     * yourIndividualList - pick from db all carts this user
     *
     * @return array
     */
    public function yourIndividualList(): array
    {
        if (isset($_COOKIE['id'])) {
            $query = "SELECT * FROM cart_name WHERE users_id = (SELECT id FROM users WHERE token = :users_id)";
            $this->query($query);
            $this->bind(':users_id', $_COOKIE['id']);
            return $this->resultSetArray();
        }
        return [];
    }
}
