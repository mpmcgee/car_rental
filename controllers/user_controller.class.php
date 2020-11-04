<?php
/*
 * Author: Coltin Espich, Danny Harris, Matthew McGee
 * Date: 11/01/2020
 * Name: index.php
 * Description: short description about this file
 */

class UserController {

    private $user_model; //Object of the UserModel class.

    //Default constructor to create an instance of the UserModel class.
    public function __construct() {
        $this->user_model = new UserModel();
    }

    //Action methods:

    //Index - display registration form - default view.
    public function index() {
        $view = new Index();
        $view->display();
    }

    //Register - store user information in database.
    public function register()
    {
        $register = $this->user_model->add_user();

        //If return value is false, return an error.
        if ($register == False) {
            $message = "There was an error registering the user.";
            $this->error($message);
            return;
        }

        $message = "successfully created account";
        $view = new Register();
        $view->display($message);
    }

    //Login - display login form.
    public function login() {
        $view = new Login();
        $view->display();
    }

    //Verify - verify a user account exists.
    public function verify() {
        $verify = $this->user_model->verify_user();

        //If return value is false, return an error.
        if ($verify == False) {
            $message = "The username or password does not exist.";
            $this->error($message);
            return;
        }

        $message = "You have successfully logged in.";
        $view = new Verify();
        $view->display($message); //If this is true, show the confirmation message on page.
    }

    //Logout - log user out of system.
    public function logout()
    {
        $logout = $this->user_model->logout();

        //If return value is false, return an error.
        if ($logout == False) {
            $message = "There was an error logging out of the system.";
            $this->error($message);
            return;
        }

        $message = "You have been successfully logged out.";
        $view = new Logout();
        $view->display($message);
    }
    //Reset - display password reset form.
    public function reset() {
        $view = new Reset();
        $view->display();
    }

    //Do_Reset - reset password in database.
    public function do_reset() {
        $reset = $this->user_model->reset_password();

        //If return value is false, return an error.
        if ($reset == False) {
            $message = "The password could not be reset.";
            $this->error($message);
            return;
        }

        $message = "Your password has been reset.";
        $view = new Verify();
        $view->display($message); //If this is true, show the confirmation message on page.
    }

    //Error - display error page.
    public function error($message) {
        $error = new UserError();
        $error->display($message);
    }

}
