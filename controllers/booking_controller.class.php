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
    private $vehicle_model;

    //default constructor
    public function __construct(){

        //create an instance of the BookingModel class
        $this->booking_model = BookingModel::getBookingModel();
        $this->vehicle_model = VehicleModel::getVehicleModel(); //Get vehicle model for vline function.
    }

    //index that displays all bookings
    public function index()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();

        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            if ($role == 1) {


                //retrieve all bookings and store them in an array
                $bookings = $this->booking_model->list_booking();

                if (!$bookings) {
                    //display error
                    $message = "There was a problem displaying bookings.";
                    $this->error($message);
                    return;
                }

                //display all bookings
                $view = new BookingIndex();
                $view->display($bookings);


            } else{
                echo("access denied");
            }
        } else {
            $view = new Login();
            $view->display();
        }
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
    public function search()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();

        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            if ($role == 1) {

                $query_terms = trim($_GET['query_terms']);

                //if search term is empty, list all bookings
                if ($query_terms == "") {
                    $this->index();
                }

                //search the database for matching bookings
                $bookings = $this->booking_model->search_bookings($query_terms);

                if ($bookings === false) {
                    //handle error
                    $message = "An error has occurred.";
                    $this->error($message);
                    return;
                }
                //display matching bookings
                $search = new BookingSearch();
                $search->display($query_terms, $bookings);
            }else{
                echo("access denied");
            }
        }  else {
            $view = new Login();
            $view->display();
        }
    }

    //Add booking - display add booking form
    public function add()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            if ($role == 1 || $role == 2) {


                $view = new BookingAdd();
                $view->display();
            }else{
                echo("access denied");
            }
        } else {
            $view = new Login();
            $view->display();
        }
    }




    public function add_Booking(){

        if (session_status() == PHP_SESSION_NONE) {
            session_start();

        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            if ($role == 1 || $role == 2) {

                $message = $this->booking_model->add_booking();

                if (strpos($message, "success") !== FALSE) {
                    $view = new Register();
                } else {
                    $view = new BookingError();
                }
                $view->display($message);

            }else{
                echo("access denied");
            }
        } else {
            $view = new Login();
            $view->display();
        }

    }




    //update a booking in the database
    public function update($id)
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();

        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];

            if ($role == 1) {
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
            }else{
                echo("access denied");
            }
        } else {
            $view = new Login();
            $view->display();
        }
    }

//show avaialble cars based on class selection.
    public function getVline($line) {
        $query_line = urldecode(trim($line));
        $vehicles_with_line = $this->vehicle_model->search_vehicles($query_line);

        if ($vehicles_with_line) {
            foreach ($vehicles_with_line as $v) {
                $vehicles[] = array(
                    "vehicle_id" => $v->getId(),
                    "year" => $v->getYear(),
                    "make" => $v->getMake(),
                    "model" => $v->getModel(),
                    "engine_type" => $v->getEngineType(),
                    "transmission" => $v->getTransmission(),
                    "class" => $v->getClass(),
                    "doors" => $v->getDoors(),
                    "line" => $v->getLine(),
                    "passengers" => $v->getPassengers(),
                    "suitcases" => $v->getSuitcases(),
                    "combined_mpg" => $v->getMPG(),
                    "sirius" => $v->getSirius(),
                    "price_per_day" => $v->getPrice()
                );
            }
        }
        echo json_encode($vehicles);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        //Note: value of $name is case sensitive
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }


}
