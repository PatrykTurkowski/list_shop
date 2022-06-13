<?php 
 require_once realpath("../../../vendor/autoload.php"); 
    use MyApp\models\databases\DbProducts;

    $prod= new DbProducts;
    $results= $prod->dbType();
    ?>

<div>
    <form action="../../controllers/addProductControll.php" method="POST">
    Name <input type="text" name="nameProduct" placeholder="Name product">
    
    Type <select name="type" id="type">
    <?php 

    foreach($results as $result)
    {
        echo '<option value="'.$result['id'].'">'.$result['category'].'</option>';
    }


    ?>
    </select>

    <input type="submit" value="Submit"name="submitNewProduct">
    
  

    </form>
</div>