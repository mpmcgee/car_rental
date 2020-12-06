<?php
/**
 * Author: Danny Harris
 * Date: 11/15/20
 * File: reset_confirm.class.php
 * Description:
 */

class ResetConfirm extends UserIndexView
{
    public function display($message) {

        //call the header method defined in the parent class to add the header
        parent::displayHeader("Reset Password Confirmation");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">RESET PASSWORD</div>

        <!-- middle row -->
        <div class="middle-row">
            <p><?= $message ?></p>
        </div>
        <!-- bottom row for links  -->
        <div class="bottom-row">
            <span style="float: left">Want to log out? <a href="<?= BASE_URL ?>/user/logout">Logout</a></span>
            <span style="float: right">Don't have an account? <a href="<?= BASE_URL ?>/user/index">Register</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::displayFooter();
    }
}