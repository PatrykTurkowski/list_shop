<?php
require_once APPROOT . '/views/includes/head.php';
?>

<div class="container">

    <?php require_once APPROOT . '/views/includes/nav.php'; ?>
    <div class="main">

        <div class="center">
            <div class='name'>
                Nane of new cart: <?php echo $data['name'] ?>
            </div>
            <div class='name'>
                <div class="form">
                    Token cart : <input type="text" value="<?php echo $data['token'] ?>" id="token" name="token" readonly style="width:300px;">
                    <button onclick="myFunction()">copy to clipboard</button>
                </div>
            </div>
            <div class='name'>
                Save your token to share other !
            </div>




        </div>
        <div class="form">
            <form action="<?php echo URLROOT; ?>carts/show" method="post">
                <button type="submit">Add first product</button>
            </form>
        </div>
    </div>
</div>