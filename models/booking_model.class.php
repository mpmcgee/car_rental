<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: booking_model.class.php
 *Description:
 */

class BookingModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblBookings;
    private $tblCustomers;
    private $tblVehicles;

    //To use singleton pattern, this constructor is made private.
    // To get an instance of the class, the getBookModel method must be called.
    private function __construct(){
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBookings = $this->db->getBookingsTable();
        $this->tblVehicles = $this->db->getVehiclesTable();
        $this->tblCustomers = $this->db->getCustomersTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initializes the customer
        if(!isset($_SESSION['customers'])){
            $customers = $this->getBookingCustomers();
            $_SESSION['customers'] = $customers;
        }

        //initializes the vehicle
        if(!isset($_SESSION['vehicles'])){
            $vehicles = $this->getBookingVehicles();
            $_SESSION['vehicles'] = $vehicles;
        }

    }

    //static method to ensure there is just one BookModel instance
    public static function getBookingModel(){
        if (self::$_instance == NULL){
            self::$_instance = new BookingModel();
        }
        return self::$_instance;
    }

    /*
     * the list_book method retrieves all bookings from the database and
     * returns an array of Booking objects if successful or false if failed.
     * Bookings should also be filtered by customer and vehicle and/or sorted by customer or vehicle.
     */

    public function list_booking(){
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblCustomers . "," .
            $this->tblVehicles . " WHERE " . $this->tblBookings . ".customer_id=" . $this->tblCustomers .
            ".customer_id AND " . $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        //if the query failed, return false
        if (!$query){
            return false;
        }

        //if the query succeeded, but no booking was found
        if($query->num_rows == 0){
            return 0;
        }

        //handle the result
        //crete an array to store all bookings
        $bookings = array();

        while($obj = $query->fetch_object()){
            $booking = new Booking(stripslashes($obj->customer_id), stripslashes($obj->last_name), stripslashes($obj->first_name),
                stripslashes($obj->vehicle_id), stripslashes($obj->vehicle_year), stripslashes($obj->vehicle_make),
                stripslashes($obj->vehicle_model), stripslashes($obj->start_date), stripslashes($obj->end_date));

            //set the id for the booking
            $booking->setId($obj->booking_id);

            //add the booking to the array
            $bookings[] = $booking;
        }
        return $bookings;

//        $this->customer_id = $customer_id;
//        $this->customer_name = $customer_name;
//        $this->vehicle_id = $vehicle_id;
//        $this->vehicle_year = $vehicle_year;
//        $this->vehicle_make = $vehicle_make;
//        $this->vehicle_model = $vehicle_model;
//        $this->start_date = $start_date;
//        $this->end_date = $end_date;

    }

    /*
     * the viewBookings method retrieves the details of the booking specified by its id
     * and returns a booking object. Return false if failed.
     */

    public function view_booking($id)
    {

        //select sql statement
        $sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblCustomers . "," .
            $this->tblVehicles . " WHERE " . $this->tblBookings . ".customer_id=" . $this->tblCustomers .
            ".customer_id AND " . $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id AND"
            . $this->tblBookings . ".booking_id='$id'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //crete a new booking object
            $booking = new Booking(stripslashes($obj->customer_id), stripslashes($obj->last_name), stripslashes($obj->first_name),
                stripslashes($obj->vehicle_id), stripslashes($obj->vehicle_year), stripslashes($obj->vehicle_make),
                stripslashes($obj->vehicle_model), stripslashes($obj->start_date), stripslashes($obj->end_date));

            //set the id for the booking
            $booking->setId($obj->id);

            return $booking;
        }

        return false;
    }
    //get all customers
    private function getBookingCustomers(){
        $sql = "SELECT * FROM " . $this->tblCustomers;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query){
            return false;
        }

        //loop through all rows
        $customers = array();
        while ($obj = $query->fetch_object()){
            $customers[$obj->customer_id] = $obj->customer_id;
        }
        return $customers;
    }

    //get all customers
    private function getBookingVehicles(){
        $sql = "SELECT * FROM " . $this->tblVehicles;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query){
            return false;
        }

        //loop through all rows
        $vehicles = array();
        while ($obj = $query->fetch_object()){
            $vehicles[$obj->vehicle_id] = $obj->vehicle_id;

        }
        return $vehicles;
    }
}