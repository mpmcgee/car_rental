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

        //create an instance of the BookingModel class
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

    //show details of a booking
    public function detail($id) {
        //retrieve the specific booking
        $booking = $this->booking_model->view_booking($id);

        if (!$booking) {
            //display an error
            $message = "There was a problem displaying the booking id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display booking details
        $view = new BookingDetail();
        $view->display($booking);
    }

    //handle an error
    public function error($message)
    {

        //create an object of the error class
        $error = new BookingError();

        //display error message
        $error->display($message);
    }

    // search bookings
    public function search(){
        $query_terms = trim($_GET['query_terms']);

        //if search term is empty, list all bookings
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching bookings
        $bookings = $this->booking_model->search_bookings($query_terms);

        if($bookings === false){
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matching bookings
        $search = new BookingSearch();
        $search->display($query_terms, $bookings);



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