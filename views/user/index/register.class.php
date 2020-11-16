<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: register.class.php
 *Description:
 */

class Register extends View
{
    public function display($message) {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">CREATE AN ACCOUNT</div>

        <!-- middle row -->
        <div class="middle-row">
            <p><?= $message ?></p>
        </div>

        <!-- bottom row for links  -->

        <div class="bottom-row">
            <span style="float: left">Want to logout? <a href="index.php?action=logout">Logout</a></span>
            <span style="float: right">Reset password? <a href="index.php?action=reset">Reset</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}