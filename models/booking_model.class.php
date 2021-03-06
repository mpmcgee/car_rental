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
    private $tblUsers;
    private $tblVehicles;

    //To use singleton pattern, this constructor is made private.
    // To get an instance of the class, the getBookModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBookings = $this->db->getBookingsTable();
        $this->tblVehicles = $this->db->getVehiclesTable();
        $this->tblUsers = $this->db->getUsersTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initializes the user
        if (!isset($_SESSION['users'])) {
            $users = $this->getBookingCustomers();
            $_SESSION['users'] = $users;
        }

        //initializes the vehicle
        if (!isset($_SESSION['vehicles'])) {
            $vehicles = $this->getBookingVehicles();
            $_SESSION['vehicles'] = $vehicles;
        }

        //initializes the vehicle
        if (!isset($_SESSION['makes'])) {
            $makes = $this->getBookingMakes();
            $_SESSION['makes'] = $makes;
        }

        //initializes the vehicle
        if (!isset($_SESSION['models'])) {
            $models = $this->getBookingModels();
            $_SESSION['models'] = $models;
        }

    }

    //static method to ensure there is just one BookingModel instance
    public static function getBookingModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new BookingModel();
        }
        return self::$_instance;
    }

    /*
     * the list_book method retrieves all bookings from the database and
     * returns an array of Booking objects if successful or false if failed.
     * Bookings should also be filtered by user and vehicle and/or sorted by user or vehicle.
     */

    public function list_booking()
    {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */
        try {
            $sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblUsers . "," .
                $this->tblVehicles . " WHERE " . $this->tblBookings . ".user_id=" . $this->tblUsers .
                ".user_id AND " . $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id";

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the booking exists.");
            }

            //if the query failed, return false
            if (!$query) {
                return false;
            }

            //if the query succeeded, but no booking was found
            if ($query->num_rows == 0) {
                return 0;
            }

            //handle the result
            //crete an array to store all bookings
            $bookings = array();

            while ($obj = $query->fetch_object()) {
                $booking = new Booking(stripslashes($obj->user_id), stripslashes($obj->last_name), stripslashes($obj->first_name),
                    stripslashes($obj->vehicle_id), stripslashes($obj->year), stripslashes($obj->make),
                    stripslashes($obj->model), stripslashes($obj->start_date), stripslashes($obj->end_date));

                //set the id for the booking
                $booking->setId($obj->booking_id);

                //add the booking to the array
                $bookings[] = $booking;
            }
            return $bookings;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /*
     * the viewBookings method retrieves the details of the booking specified by its id
     * and returns a booking object. Return false if failed.
     */

    public function view_booking($id)
    {
        try {
            //select sql statement
            $sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblUsers . "," .
                $this->tblVehicles . " WHERE " . $this->tblBookings . ".user_id=" . $this->tblUsers .
                ".user_id AND " . $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id AND"
                . $this->tblBookings . ".booking_id='$id'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the booking exists.");
            }

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //crete a new booking object
                $booking = new Booking(stripslashes($obj->user_id), stripslashes($obj->last_name), stripslashes($obj->first_name),
                    stripslashes($obj->vehicle_id), stripslashes($obj->year), stripslashes($obj->make),
                    stripslashes($obj->model), stripslashes($obj->start_date), stripslashes($obj->end_date));

                //set the id for the booking
                $booking->setId($obj->id);

                return $booking;
            }

            return false;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function search_bookings($terms)
    {
        try {
            $terms = explode(" ", $terms); //explode multiple terms into an array

            //Check for missing data.
            if ($terms == "") {
                throw new DataMissingException("Please enter a booking.");
            }

            //select statement for AND search
            $sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblUsers . "," .
                $this->tblVehicles . " WHERE " . $this->tblBookings . ".user_id=" . $this->tblUsers .
                ".user_id AND " . $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id AND (1";

            foreach ($terms as $term) {
                $sql .= " AND last_name LIKE '%" . $term . "%' OR  first_name LIKE '%" . $term . "%' 
                OR model LIKE '%" . $term . "%' OR make LIKE '%" . $term . "%' OR booking_id LIKE '%" . $term . "%'
                OR year LIKE '%" . $term . "%'";


            }

            $sql .= ")";

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the booking exists.");
            }

            // the search failed, return false.
            if (!$query) {
                return false;
            }

            if ($query->num_rows == 0) {
                return 0;
            }

            //search succeeded and at least one booking found
            //create an array to store all returned bookings
            $bookings = array();

            //loop through all rows and crete recordsets
            while ($obj = $query->fetch_object()) {
                $booking = new Booking($obj->user_id, $obj->last_name, $obj->first_name,
                    $obj->vehicle_id, $obj->year, $obj->make,
                    $obj->model, $obj->start_date, $obj->end_date);

                //set the id for the booking
                $booking->setId($obj->booking_id);

                //add the booking to the array
                $bookings[] = $booking;
            }

            return $bookings;
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //the add booking method a new booking to the database. Details of the booking are posted in a form. Return true if succeed; false otherwise.
    public function add_booking()
    {


        //retrieve data for the new movie; data are sanitized and escaped for security.
        $vehicle_id = (int)$this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'pick_car', FILTER_SANITIZE_NUMBER_INT)));
        $start_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_STRING)));
        $end_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_STRING)));

        try {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();

            }
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                //Check for missing data.
                    if ($vehicle_id == "" || $start_date == "" || $end_date == "") {
                        throw new DataMissingException("Please complete all fields.");
                    }

                //query string for update
                $sql = "INSERT INTO " . $this->tblBookings .
                    " VALUES (NULL, '$vehicle_id', '$user_id', '$start_date', '$end_date')";

                //execute the query and return true if successful or false if failed
                $query = $this->dbConnection->query($sql);


                if (!$query) {
                    throw new DatabaseException("There was an error adding your booking.");
                } else {
                    return "Your booking was successfully created.";
                }


            }
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        }
    }


    //the add booking method a new booking to the database. Details of the booking are posted in a form. Return true if succeed; false otherwise.
    public function update_booking($id)
    {
        try {
            //if the script did not received post data, display an error message and then terminate the script immediately
            if (!filter_has_var(INPUT_POST, 'first-name') ||
                !filter_has_var(INPUT_POST, 'last-name') ||
                !filter_has_var(INPUT_POST, 'Vehicle-id') ||
                !filter_has_var(INPUT_POST, 'start-date') ||
                !filter_has_var(INPUT_POST, 'end-date')) {

                return false;
            }

            //retrieve data for the new booking; data are sanitized and escaped for security.
            $first_name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING)));
            $last_name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING)));
            $vehicle_id = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'vehicle-id', FILTER_DEFAULT));
            $start_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_STRING)));
            $end_date = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_STRING)));

            //Check for missing data.
            if ($first_name == "" || $last_name == "" || $vehicle_id == "" || $start_date == "" || $end_date == "") {
                throw new DataMissingException("Please complete all fields.");
            }

            //query string for update
            $sql = "UPDATE " . $this->tblBookings .
                " SET first_name='$first_name', last_name='$last_name', vehicle_id='$vehicle_id', start_date='$start_date', "
                . "end_date='$end_date' WHERE id='$id'";

            //execute the query and return true if successful or false if failed
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("There was an error updating user to the database.");
            }

            if (is_null($query)) {
                return false;

                //set cookie with username and return true
            } else {

                return true;
            }
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    //get all users

    private function getBookingCustomers()
    {
        try {

            $sql = "SELECT * FROM " . $this->tblUsers;

            //execute the query and return true if successful or false if failed
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("There was an error getting customer from database.");
            }

            //loop through all rows
            $users = array();
            while ($obj = $query->fetch_object()) {
                $users[$obj->user_id] = $obj->user_id;
            }
            return $users;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    //get all vehicle
    private function getBookingVehicles()
    {
        try {
            $sql = "SELECT * FROM " . $this->tblVehicles;

            //execute the query and return true if successful or false if failed
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("There was an error getting the vehicle from the database.");
            }

            //loop through all rows
            $vehicles = array();
            while ($obj = $query->fetch_object()) {
                $vehicles[$obj->vehicle_id] = $obj->vehicle_id;


            }
            return $vehicles;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //get all makes
    private function getBookingMakes()
    {
        try {
            $sql = "SELECT * FROM " . $this->tblVehicles;

            //execute the query and return true if successful or false if failed
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("There was an error getting the vehicle make from the database.");
            }

            //loop through all rows
            $makes = array();
            while ($obj = $query->fetch_object()) {
                $makes[$obj->make] = $obj->make;


            }
            return $makes;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //get all makes
    private function getBookingModels()
    {
        try {
            $sql = "SELECT * FROM " . $this->tblVehicles;

            //execute the query and return true if successful or false if failed
            $query = $this->dbConnection->query($sql);
            if (!$query) {
                throw new DatabaseException("There was an error getting the vehicle model from the database.");
            }

            //loop through all rows
            $models = array();
            while ($obj = $query->fetch_object()) {
                $models[$obj->model] = $obj->model;


            }
            return $models;
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
