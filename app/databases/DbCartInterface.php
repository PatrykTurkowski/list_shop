<?php



interface DbCartInterface
{

    function showAllProductInCart(string $token): array;
    function addNewProductToCart(string $token, int $product_id): void;
    function deleteCart(string $token): void;
    function editNameCart(string $token, string $newName): void;
    function createCart(string $cartName): string;
    function deleteProductFromCart(string $token, string $name): void;
    function isCart(string $token): bool;
    function cartName(string $token): string;
    function countCarts(): int;
    function isProductInCart(string $token, int $id): bool;
}
