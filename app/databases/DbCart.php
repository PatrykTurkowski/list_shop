<?php

require_once '../app/databases/DbCartInterface.php';
/**
 * DbCart
 */
class DbCart extends Database implements DbCartInterface
{


    function __construct()
    {
        parent::__construct();
    }
    /**
     * showAllProductInCart
     *
     * @param string $token
     * @return array
     */
    function showAllProductInCart(string $token): array
    {
        $query = "SELECT 
                    DISTINCT
                    cn.name AS 'NameCart',
                    p.name AS 'Product', 
                    pt.name AS 'Category'
                FROM 
                    cart as c LEFT JOIN cart_name as cn 
                    ON cn.id=c.cart_name_id 
                    LEFT JOIN product as p 
                    ON c.product_id = p.id 
                    LEFT JOIN product_type as pt 
                    ON p.product_type_id = pt.id 
                WHERE 
                    cn.token =:token;";
        $this->query($query);
        $this->bind(':token', $token);
        return $this->resultSetArray();
    }

    /**
     * addNewProductToCart
     *
     * @param  string $token
     * @param  int $product_id
     * @return void
     */
    function addNewProductToCart(string $token, int $product_id): void
    {
        $query = "INSERT INTO cart(cart_name_id, product_id) 
            VALUES ((SELECT id FROM cart_name WHERE token = :token),:product_id);";
        $this->query($query);
        $this->bind(':token', $token);
        $this->bind(':product_id', $product_id);
        $this->execute();
    }

    function createCart(string $cartName): string
    {
        $token = sha1(uniqid('php_', true));
        $query = "INSERT INTO cart_name (`name`, `token`, `users_id`)
                VALUES (:cartName, :token,(SELECT id FROM users WHERE token = :users_id))";
        $this->query($query);
        $this->bind(':token', $token);
        $this->bind(':cartName', $cartName);
        $this->bind(':users_id', $_COOKIE['id']);
        $this->execute();
        return $token;
    }
    /**
     * deleteCart
     *
     * @param  string $token
     * @return void
     */
    function deleteCart(string $token): void
    {
        $query = "DELETE FROM cart WHERE cart_name_id = (SELECT id FROM cart_name WHERE token = :token)";
        $this->query($query);
        $this->bind(':token', $token);
        $this->execute();
        $query = "DELETE FROM cart_name WHERE token=:token;";
        $this->query($query);
        $this->bind(':token', $token);
        $this->execute();

        header('location:' . URLROOT . 'home/index/');
    }

    function deleteProductFromCart(string $token, string $name): void
    {
        $query = "DELETE FROM cart WHERE product_id = (SELECT id FROM product WHERE name = :name) AND cart_name_id = (SELECT id FROM cart_name WHERE token = :token)";
        $this->query($query);
        $this->bind(':name', $name);
        $this->bind(':token', $token);
        $this->execute();
    }
    /**
     * editNameCart
     * dont used !!!!!!!!!!!
     * @param  string $token
     * @param  string $newCartName
     * @return void
     */
    function editNameCart(string $token, string $newCartName): void
    {

        $query = "UPDATE cart_name
                SET name = :newCartName
                WHERE token=:token;";
    }

    /**
     * isCart - check exist cart
     *
     * @param  string $token
     * @return bool
     */
    function isCart(string $token): bool
    {
        $query = "SELECT COUNT(*) AS count FROM cart_name WHERE token=:token";
        $this->query($query);
        $this->bind(':token', $token);
        $count = $this->featchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * cartName
     *
     * @param  string $token
     * @return string
     */
    function cartName(string $token): string
    {
        $query = 'SELECT * FROM cart_name WHERE token = :token;';
        $this->query($query);
        $this->bind(':token', $token);
        $name = $this->single();

        $lol = $name['name'];

        return $lol;
    }

    /**
     * countCarts - count carts for one user
     *
     * @return int
     */
    function countCarts(): int
    {
        $query = "SELECT count(*) FROM `cart_name` WHERE users_id = (SELECT id FROM users WHERE token = :token);";
        $this->query($query);
        $this->bind(':token', $_COOKIE['id']);
        return $this->featchColumn();
    }

    /**
     * isProductInCart - check that product is in the cart
     *
     * @param  string $token
     * @param  int $id
     * @return bool
     */
    function isProductInCart(string $token, int $id): bool
    {
        $query = "SELECT COUNT(*) AS count FROM cart
                  WHERE cart_name_id = (SELECT id FROM cart_name WHERE token = :token)
                  AND product_id =:id ";

        $this->query($query);
        $this->bind(':token', $token);
        $this->bind(':id', $id);
        $count = $this->featchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
