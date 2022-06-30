<?php



interface DbProductInterface
{

    function showTypes(): array;
    function productListType(int $idType);
}
