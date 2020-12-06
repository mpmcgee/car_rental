<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: verify_user.class.php
 *Description:
 */

class VerifyUser extends UserIndexView
{
    public function display($message) {

        //call the header method defined in the parent class to add the header
        parent::displayHeader("Verify User");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">LOGIN</div>

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