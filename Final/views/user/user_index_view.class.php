<?php
/**
 * Author: Danny Harris
 * Date: 11/16/20
 * File: user_index_view.class.php
 * Description:
 */

class UserIndexView extends IndexView
{
    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "user";
        </script>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Rental User Management System</title>
        <link href="www/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <h1><span style="color: forestgreen; font-family: serif; font-size: 36pt">Rental</span> User Management System</h1>
    <div id="wrapper">
        <img src="www/img/gfif.jpg" style="float: right; width: 130px">
        <?php
        }

        //create the page footer
        public static function footer() {
        ?>
    </div>
    </body>
    </html>
    <?php
}

    public static function displayFooter() {
        parent::displayFooter();
    }
}