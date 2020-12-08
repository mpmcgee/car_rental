<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: login.class.php
 *Description:
 */

class Login extends UserIndexView
{
    public function display() {

        //call the header method defined in the parent class to add the header
        parent::displayHeader("Login");
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">LOGIN</div>

        <!-- middle row -->
        <div class="middle-row">
            <h3>Please enter your username and password.</h3>
            <form method="POST" action='<?= BASE_URL ?>/user/verify'>
                <p>
                <input id="username" value="" name="username" type="text" placeholder="Username"/>
                    <br>
                </p>
                <p>
                    <input id="password" value="" name="password" type="password" placeholder="Password"/>
                    <br>
                </p>
                <button type="submit" style="width: 560px; background-color: #333333; height: 50px; color: white"><span>Login</span></button>
            </form>
        </div>

        <!-- bottom row for links  -->
        <div class="bottom-row">
            <span style="float: left">Don't have an account? <a href="<?= BASE_URL ?>/user/index">Register</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::displayFooter();
    }
}
