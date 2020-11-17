<?php
/**
 * Author: Danny Harris
 * Date: 11/16/20
 * File: user_index_view.class.php
 * Description:
 */

class UserIndexView extends IndexView
{
    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "user";
        </script>
        <!-- page specific content starts -->
        <!-- top row for the page header  -->
        <div class="top-row">CREATE AN ACCOUNT</div>
        <div class="header">
            <h3>Please complete the entire form. All fields required.</h3>
        </div>
        <!-- middle row -->
        <div class="middle-row">
            <form method="POST" action="index.php?action=register">
                <p>
                    <input id="username" value="" name="username" type="text" required="required" placeholder="Username"/>
                    <br>
                </p>
                <p>
                    <input id="password" value="" name="password" type="text" required="required" placeholder="Password, 5 characters minimum"/>
                    <br>
                </p>
                <p>
                    <input id="email" value="" name="email" type="email" required="required" placeholder="Email"/>
                    <br>
                </p>
                <p>
                    <input id="firstname" value="" name="firstname" type="text" required="required" placeholder="First name"/>
                    <br>
                </p>
                <p>
                    <input id="lastname" value="" name="lastname" type="text" required="required" placeholder="Last name"/>
                    <br>
                </p>
                <button type="submit" style="width: 560px; background-color: #333333; height: 50px; color: white"><span>Register</span></button>
            </form>
        </div>
        <hr>
        <!-- bottom row for links  -->
        <div class="bottom-row">
            <span style="float: left">Already have an account? <a href="<?= BASE_URL ?>/user/login">Login</a></span>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}