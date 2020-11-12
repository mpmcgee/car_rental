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

    //Register - store user information in database.
    public function book()
    {
        $booking = $this->booking_model->add_booking();

        //If return value is false, return an error.
        if ($booking == False) {
            $message = "There was an error booking the vehicle.";
            $this->error($message);
            return;
        }

        $message = "Booking successfully created.";
        $view = new Booking();
        $view->display($message);
    }

    //show details of a booking
    public function detail($id){

        //retrieve the specific booking
        $booking = $this->booking_model->view_booking($id);

        if (!$booking) {
            $message = "There was a problem displaying the booking with id'" . $id . "'.";
        }

        //display the booking results
        $view = new BookingDetail();
        $view->display($booking);
    }

    //display a booking in a form for editing
    public function edit($id) {
        //retrieve the specific booking
        $booking = $this->booking_model->view_booking($id);

        if (!$booking) {
            //display an error
            $message = "There was a problem displaying the booking id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new BookingEdit();
        $view->display($booking);
    }

    //update a booking in the database
    public function update($id) {
        //update the booking
        $update = $this->booking_model->update_booking($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the booking id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updated booking details
        $confirm = "The booking was successfully updated.";
        $booking = $this->booking_model->view_booking($id);

        $view = new BookingDetail();
        $view->display($booking, $confirm);
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