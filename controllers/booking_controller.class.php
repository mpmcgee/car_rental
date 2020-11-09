<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: booking_controller.class.php
 *Description:
 */

class BookingController
{
    private $booking_model;

    //default constructor
    public function __construct(){
        $this->booking_model = BookingModel::getBookingModel();
    }

    //index that displays all bookings
    public function index(){

        //retrieve all bookings and store them in an array
        $bookings = $this->booking_model->list_booking();

        if (!$bookings){
            //display error
            $message = "There was a problem displaying bookings.";
            $this->error($message);
            return;
        }

        //display all bookings
        $view = new BookingIndex();
        $view->display($bookings);
    }

    //handle an error
    public function error($message)
    {

        //create an object of the error class
        $error = new BookingError();

        //display error message
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments)
    {
        //$message = "Route does not exist.";
        //Note: value of $name is case sensitive
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }


}