<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: vehicle_error.class.php
 *Description:
 */

class VehicleError extends View
{
    public function display($message){

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>



?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title>ToyMVC Error</title>
        <link type="text/css" rel="stylesheet" href="../../www/css/style.css" />
    </head>
    <body>
    <table width='500'>
        <tr>
            <td valign='center' align='center'>
                <img src='includes/kaboom.png' border='0'/>
            </td>
            <td valign='top' align='left'>
                <h3> We're sorry, but an error has occurred.</h3>
                <?php echo $message; ?>
                <p><a href="index.php">HOME</a></p>
            </td>
        </tr>
    </table>
    </body>
    </html>
<?php


        //call the footer method defined in the parent class to add the footer
        parent::footer();
    } // end of display method
}// end of error class
?>
