<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: welcome.controller.class.php
 *Description:
 */

class WelcomeController {
    //put your code here
    public function index() {
        $view = new WelcomeIndex();
        $view->display();
    }
}