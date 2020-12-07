<?php
/**
 * Author: Matthew McGee
 * Date: 12/6/2020
 * File: booking_add.php
 *Description:
 */

class AddBooking extends BookingIndexView {

    public function display($message) {

        //call the header method defined in the parent class to add the header
        parent::displayHeader("Add a Booking");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">Add a booking</div>

        <!-- middle row -->
        <div class="middle-row">
            <p><?= $message ?></p>
        </div>

        <!-- bottom row for links  -->
        <div class="bottom-row">
            <span style="float: left">Want to logout? <a href="<?= BASE_URL ?>/user/logout">Logout</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::displayFooter();
    }

}