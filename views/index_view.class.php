<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: index_view.class.php
 *Description:
 */

class IndexView {

    //this method displays the page header
    static public function displayHeader($page_title){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title> <?php echo $page_title ?> </title>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <link rel='shortcut icon' href='<?= BASE_URL ?>/www/img/xcarrental.png' type='image/x-icon'/>
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/style.css' />
            <script>
                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";
            </script>
        </head>
    <body>

        <div id="top"></div>
    <div id='wrapper'>
        <div id="banner">


            <ul class="navbar">
                <li><a href="<?= BASE_URL ?>/booking/index">View Bookings</a></li>
                <li><a href="<?= BASE_URL ?>/vehicle/index">View Vehicles</a></li>
                <li><a href="<?= BASE_URL ?>/booking/add">Create a booking</a></li>
                <li><a href="#contact">Contact</a></li>
                <div id="logo"><li><a href="<?= BASE_URL ?>/index.php">X Car Rental</a> </li></div>
                <li style="float:right"><a class="active" href="<?= BASE_URL ?>/user/login">Login</a></li>
            </ul>


        </div>

        <?php

    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter() {
        ?>
        <br><br><br>
        <div id="push"></div>
        </div>
        <div id="footer"><br>&copy 2020 X Car Rental. All Rights Reserved.</div>
<!--        <script type="text/javascript" src="--><?//= BASE_URL ?><!--/www/js/ajax_autosuggestion.js"></script>-->
        </body>
        </html>
        <?php
    } //end of displayFooter function

}