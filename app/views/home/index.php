<?php
require_once APPROOT . '/views/includes/head.php';
?>


<div id="simplecookienotification_v01" style="display: block; z-index: 99999; min-height: 35px; width: 100%; position: fixed; background: rgb(245, 245, 245); border-image: initial; border-width: 5px 0px 0px; border-top-style: solid; border-color: rgb(139, 195, 74); text-align: center; right: 0px; color: rgb(119, 119, 119); bottom: 0px; left: 0px; border-right-style: initial; border-bottom-style: initial; border-left-style: initial;">
    <div style="padding:10px; margin-left:15px; margin-right:15px; font-size:14px; font-weight:normal;">
        <span id="simplecookienotification_v01_powiadomienie">Używamy cookies w celach funkcjonalnych, aby ułatwić użytkownikom korzystanie z witryny oraz w celu tworzenia anonimowych statystyk serwisu. Jeżeli nie blokujesz plików cookies, to zgadzasz się na ich używanie oraz zapisanie w pamięci urządzenia.</span><span id="br_pc_title_html"><br></span>
        <a id="simplecookienotification_v01_polityka" href="http://jakwylaczyccookie.pl/polityka-cookie/" style="color: rgb(139, 195, 74);">Polityka Prywatności</a><span id="br_pc2_title_html"> &nbsp;&nbsp; </span>
        <a id="simplecookienotification_v01_info" href="http://jakwylaczyccookie.pl/jak-wylaczyc-pliki-cookies/" style="color: rgb(139, 195, 74);">Jak wyłączyć cookies?</a><span id="br_pc3_title_html"> &nbsp;&nbsp; </span>
        <a id="simplecookienotification_v01_info2" href="https://nety.pl/cyberbezpieczenstwo" style="color: rgb(139, 195, 74);">Cyberbezpieczeństwo</a>
        <div id="jwc_hr1" style="height: 10px; display: none;"></div>
        <a id="okbutton" href="javascript:simplecookienotification_v01_create_cookie('simplecookienotification_v01',1,20000);" style="position: absolute; background: rgb(255, 255, 255); color: rgb(139, 195, 74); padding: 5px 15px; text-decoration: none; font-size: 12px; font-weight: normal; border: 1px solid rgb(139, 195, 74); border-radius: 0px; top: 40px; right: 5px;">OK</a>
        <div id="jwc_hr2" style="height: 10px; display: none;"></div>
    </div>
</div>
<script type="text/javascript">
    var galTable = new Array();
    var galx = 0;
</script>
<script type="text/javascript">
    function simplecookienotification_v01_create_cookie(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
        document.getElementById("simplecookienotification_v01").style.display = "none";
    }

    function simplecookienotification_v01_read_cookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == " ") c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
    var simplecookienotification_v01_jest = simplecookienotification_v01_read_cookie("simplecookienotification_v01");
    if (simplecookienotification_v01_jest == 1) {
        document.getElementById("simplecookienotification_v01").style.display = "none";
    }
</script>
<div class="container">
    <div class="left-bar">
        <div class="create">
            <div class="header">
                Create new shopping cart
            </div>
            <div class="form">
                <form action="<?php echo URLROOT; ?>carts/create" method="post">
                    <input type="text" autocomplete="off" placeholder="Name of Shopping Cart" default="list of products" name="cartName">
                    <br>
                    <button type="submit">Create</button>
                    <br>
                    <span class="red-alert">
                        <?php
                        if (isset($_SESSION['countCarts'])) {
                            echo $_SESSION['countCarts'];
                        }

                        ?>
                    </span>
                </form>
            </div>
        </div>
        <div class="search">
            <div class="header">
                Find your shopping cart
            </div>
            <div class="form">
                <form action="<?php echo URLROOT; ?>carts/findCart" method="post">
                    <input type="text" autocomplete="off" placeholder="Token" name="token">
                    <br>
                    <button type="submit">search</button>
                    <br>
                    <span class="red-alert">
                        <?php
                        if (isset($_SESSION['errorMsg'])) {
                            echo $_SESSION['errorMsg'];
                        }

                        ?>
                    </span>
                </form>
            </div>

        </div>

    </div>
    <div class="right-bar">
        <div class="header">
            List of your cards
        </div>
        <div class="form2">

            <table>
                <?php

                foreach ($data['list'] as $list) {

                    echo '<tr><form action="' . URLROOT . 'carts/findCart" method="POST">';
                    echo '<td><button name="token" value = "' . $list['token'] . '">';
                    echo $list['name'];
                    echo '</button></td></form>';
                    echo ' <form action=' . URLROOT . 'carts/deleteCart method="POST">';
                    echo '<td><button name="token" value = "' . $list['token'] . '">';
                    echo '<i class = "icon-trash-empty"></i>';
                    echo '</button></td>';
                    echo '</form>';
                    echo '</tr>';
                }

                ?>

            </table>

        </div>
    </div>
</div>
<?php
// session_unset();

?>