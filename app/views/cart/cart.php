<!-- koszyk <br>
produkty
<br>
dodaj nowy produkt <br> -->

<?php
require_once APPROOT . '/views/includes/head.php';
?>
<!-- <script>
    document.addEventListener('DOMContentLoaded',()=>{
    let chk=document.querySelector('input[type="checkbox"][name="sharks"]');
        chk.checked=localStorage.getItem( chk.name )==null || localStorage.getItem( chk.name )=='false' ? false : true;
        
        chk.addEventListener('click',e=>{
            localStorage.setItem( chk.name, chk.checked )
            location.reload();
        });
});
</script> -->
<div class="container">
    <?php
    require_once APPROOT . '/views/includes/nav.php';
    ?>

    <div class="">

        <div class="list">


            <table>
                <tr>
                    <th colspan="5">
                        <div class="header">
                            <?php echo $data['name'] ?>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>Lp.</td>
                    <td>Name</td>
                    <td>Type</td>
                    <td>Check</td>
                    <td>Delete</td>

                </tr>

                <form action="<?php echo URLROOT; ?>carts/deleteProduct" method="post">


                    <?php
                    //print_r($data['products']);
                    foreach ($data['products'] as $key => $product) {
                        echo '<tr>';
                        echo '<td>';
                        echo $key + 1;
                        echo '</td>';
                        echo '<td>';
                        echo $product['Product'];
                        echo '</td>';
                        echo '<td>';
                        echo $product['Category'];
                        echo '</td>';
                        echo '<td>';
                        echo '<input name ="sharks" id = "sharks" type="checkbox">';
                        echo '</td>';

                        echo '<td>';
                        echo '<button type="submit" name=nameProduct value=' . $product['Product'] . '>';
                        echo '<i class = "icon-trash-empty"></i>';
                        echo '</button>';
                        echo '</td>';



                        echo '</tr>';
                    }
                    ?>
                </form>
            </table>

            <div class="form">
                <form action="<?php echo URLROOT; ?>carts/showTypes" method="post">
                    <button type="submit">Add New Product</button>
                </form>
                <div class="token">
                    Token cart : <input type="text" value="<?php echo $data['token'] ?>" id="token" name="token" readonly style="width:300px;">
                    <button onclick="myFunction()">copy to clipboard</button>
                </div>
            </div>
        </div>


    </div>

</div>