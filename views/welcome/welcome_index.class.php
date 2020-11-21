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



        <div id="main-header">Welcome to X Car Rental!</div>
        <p>This application is designed to demonstrate the popular software design pattern named MVC. The application hosts three different media types: booking, vehicles, and login. The application is meant to be flexible and extensible.</p>
        <br>
        <table style="border: none; width: 700px; margin: 5px auto">
            <tr>
                <td colspan="2" style="text-align: center"><strong>Major features include:</strong></td>
            </tr>
            <tr>
                <td style="text-align: left">
                    <ul>
                        <li>List all media</li>
                        <li>Display details of specific media</li>
                        <li>Update or delete existing media</li>
                        <li>Add new media</li>
                    </ul>
                </td>
                <td style="text-align: left">
                    <ul>
                        <li>Search for media</li>
                        <li>Autosuggestion</li>
                        <li>Filter media</li>
                        <li>Sort media</li>
                        <li>Pagination</li>
                    </ul></td>
            </tr>
        </table>

        <br>



        <div id="thumbnails" style="text-align: center; border: none">
            <p>Click an image below to explore a library. Click the logo in the banner to come back to this page.</p>

            <a href="<?= BASE_URL ?>/booking/index">
                <img src="<?= BASE_URL ?>/www/img/movies.jpg" title="Bookings"/>
            </a>
            <a href="<?= BASE_URL ?>/vehicle/index">

            </a>
            <a href="<?= BASE_URL ?>/user/index">

            </a>
            <a href="#">
                <img src="<?= BASE_URL ?>/www/img/music.jpg" title="Music Library (Under Construction)" />
            </a>
        </div>
        <br>
        <p style="text-align: center; color: red; font-weight: bold">Disclaimer</p>
        <p style="font-style: italic">This application is created as a course project for I211. It is solely for teaching and learning purposes. As a course project, the goal is to learn how to do things, but not to get things done. Therefore, the code used in this project may not be most efficient or most effective. Furthermore, the code has not been tested in any production environment. If you want to use any code in this project in any production environment, use it at your own risk.</p><br>


        <?php
        Parent::displayFooter();

    }



}