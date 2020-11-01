<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: reset.class.php
 *Description:
 */

class Reset extends View
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