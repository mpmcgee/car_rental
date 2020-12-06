<?php
/**
 * Author: Matthew McGee
 * Date: 12/6/2020
 * File: add.class.php
 *Description:
 */

class Add extends BookingIndexView {

    public function display($message) {

        //call the header method defined in the parent class to add the header
        parent::displayHeader("Create Booking");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">CREATE A BOOKING</div>

        <!-- middle row -->
        <div class="middle-row">
            <p><?= $message ?></p>
        </div>

        <!-- bottom row for links  -->

        <div class="bottom-row">
            <span style="float: left">Want to logout? <a href="<?= BASE_URL ?>/user/logout">Logout</a></span>
            <span style="float: right">Reset password? <a href="<?= BASE_URL ?>/user/reset">Reset</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::displayFooter();
    }

}