<?php
require_once '../app/databases/DbCart.php';
require_once '../app/databases/DbProduct.php';
class Cart
{
    // public $db;
    // public $dbProd;
    // public $token;
    // public $name;
    public function __construct()
    {
        $this->db = new DbCart;
        $this->dbProd = new DbProduct;
    }

    public function create(string $name): void
    {
        $this->token = $this->db->createCart($name);
    }

    public function showCart(string $token): array
    {
        return $this->db->showAllProductInCart($token);
    }

    public function showTypes(): array
    {
        return $this->dbProd->showTypes();
    }

    public function productListType(int $idType): array
    {
        return $this->dbProd->productListType($idType);
    }

    public function addNewProductToCart(string $token, int $product_id): void
    {
        $this->db->addNewProductToCart($token, $product_id);
    }

    public function isCart(string $token): bool
    {
        return $this->db->isCart($token);
    }

    public function cartName(string $token): string
    {
        return $this->db->cartName($token);
    }
    public function countCarts(): int
    {
        return $this->db->countCarts();
    }

    public function cartDelete(string $token): void
    {
        $this->db->deleteCart($token);
    }

    public function productDelete(string $token, string $name): void
    {
        $this->db->deleteProductFromCart($token, $name);
    }
    public function isProductInCart(string $token, string $name): bool
    {
        return $this->db->isProductInCart($token, $name);
    }
}
