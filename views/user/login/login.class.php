<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: login.class.php
 *Description:
 */

class Login extends View
{
    public function display() {

        //call the header method defined in the parent class to add the header
        parent::header();
        ?>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">LOGIN</div>

        <!-- middle row -->
        <div class="middle-row">
            <h3>Please enter your username and password.</h3>
            <form method="POST" action="index.php?action=verify">
                <p>
                    <input id="username" value="" name="username" type="text" required="required" placeholder="Username"/>
                    <br>
                </p>
                <p>
                    <input id="password" value="" name="password" type="text" required="required" placeholder="Password"/>
                    <br>
                </p>
                <button type="submit" style="width: 560px; background-color: #333333; height: 50px; color: white"><span>Login</span></button>
            </form>
        </div>

        <!-- bottom row for links  -->
        <div class="bottom-row">
            <span style="float: left">Don't have an account? <a href="index.php">Register</a></span>
        </div>
        <!-- page specific content ends -->


        <?php
        //call the footer method defined in the parent class to add the footer
        parent::footer();
    }
}