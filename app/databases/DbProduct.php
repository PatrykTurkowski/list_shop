<?php

require_once '../app/databases/DbProductInterface.php';
/**
 * DbProduct
 */
class DbProduct extends Database implements DbProductInterface
{


  /**
   * __construct - induces construct father
   *
   * @return void
   */
  function __construct()
  {
    parent::__construct();
  }

  /**
   * showTypes - ahow all category 
   *
   * @return array
   */
  public function showTypes(): array
  {
    $query = "SELECT * FROM product_type;";
    $this->query($query);
    return $this->resultSetArray();
  }

  /**
   * productListType - show products of single category 
   *
   * @param  mixed $idType
   * @return void
   */
  public function productListType(int $idType)
  {
    $query = "SELECT * FROM product WHERE product_type_id =:idType";
    $this->query($query);
    $this->bind(':idType', $idType);
    return $this->resultSetArray();
  }
}
