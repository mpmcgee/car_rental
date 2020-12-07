<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: welcome_index.class.php
 *Description:
 */

class WelcomeIndex extends IndexView{

    public function display() {
        parent::displayHeader("X Car Rental Home");

        ?>



        <div class="img_container">
            <img src="www/img/background_img.jpeg" alt="home_img" id="home_img"/>
            <div class="centered">X Car Rental is an interactive web application built with MVC. Please create an account and book the vehicle that best suits your future adventure. </div>
        </div>


        <br>

        <p class="sub-text">Find the vehicle that is right for you</p>
        <hr>

        <!--create the search bar -->
        <div class="search">
            <form method="get" action="<?= BASE_URL ?>/vehicle/search">
                <input class="vehicles" type="text" name="query_terms" id="searchtextbox" placeholder="Search Vehicles" autocomplete="on">
                <input type="submit" value="Go"/>
            </form>
            <div id="suggestionDiv"></div>
        </div>

        <hr>
        <br>

        <img src="www/img/person_on_computer.jpg" alt='person_computer' id="person_computer">
        <br><br><br><br><br><br><br><br>
        <p class="img_text"> If you already have an account log in <a href="<?= BASE_URL ?>/user/login">here.</a></p>



        <br><br><br><br><br><br><br><br><br><br><br><br><hr><br>
        <p style="text-align: center; color: red; font-weight: bold">Disclaimer</p>
        <p style="font-style: italic">This application is created as a course project for I211. It is solely for teaching and learning purposes. As a course project, the goal is to learn how to do things, but not to get things done. Therefore, the code used in this project may not be most efficient or most effective. Furthermore, the code has not been tested in any production environment. If you want to use any code in this project in any production environment, use it at your own risk.</p><br>


        <?php
        Parent::displayFooter();

    }



}