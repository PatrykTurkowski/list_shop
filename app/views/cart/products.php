<?php
require_once APPROOT . '/views/includes/head.php';
?>


<div class="container">
    <?php
    require_once APPROOT . '/views/includes/nav.php';
    ?>
    <div class="header">
        List of products
    </div>
    <div class="form">
        <form action="<?php echo URLROOT; ?>carts/addProduct" method="post">
            <?php
            // print_r($data['types']);
            foreach ($data['products'] as $product) {

                echo '<button type="submit" name="product" value = ' . $product['id'] . '>' . $product['name'] . '</button>';
            }

            ?>
        </form>
    </div>

</div>