<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: view.class.php
 *Description:
 */

class View
{
    //create the page header
    public static function header() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>MDC Car Rental</title>
            <link href="www/css/styles.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
        <h1><span style="color: forestgreen; font-family: serif; font-size: 36pt">MDC Car Rental</span></h1>
        <div id="wrapper">
        <img src="www/img/logo.png" style="float: right; width: 130px">
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

}
}