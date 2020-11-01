<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: logout.class.php
 *Description:
 */

class Logout extends View
{
public function display() {

//call the header method defined in the parent class to add the header
parent::header();
?>

    <?php
    //call the footer method defined in the parent class to add the footer
    parent::footer();
}
}