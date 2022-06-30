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
        <form action="<?php echo URLROOT; ?>carts/showSingleType" method="post">
            <?php
            // print_r($data['types']);
            foreach ($data['types'] as $type) {

                echo '<button type="submit" name="type" value = ' . $type['id'] . '>' . $type['name'] . '</button>';
            }

            ?>
        </form>
    </div>

</div>