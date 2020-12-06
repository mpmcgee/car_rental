<?php
/**
 * Author: Matthew McGee, Danny Harris
 * Date: 10/24/2020
 * File: database.class.php
 *Description:
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'rental',
        'tblVehicles' => 'vehicles',
        'tblBookings' => 'bookings',
        'tblUsers' => 'users'
    );

    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //private constructor
    private function __construct(){
        $this->objDBConnection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );
        if (mysqli_connect_errno() != 0){
            $message =  "Failed to connect to database: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //static method to ensure only one Database instance
    static public function getDatabase(){
        if (self::$_instance == NULL)
            self::$_instance = new Database;
        return self::$_instance;
    }

    //function to return the database connection object
    public function getConnection(){
        return $this->objDBConnection;
    }

    //returns name of table that stores vehicles
    public function getVehiclesTable(){
        return $this->param['tblVehicles'];
    }

    //returns name of table that stores bookings
    public function getBookingsTable(){
        return $this->param['tblBookings'];
    }

    //returns name of table that stores bookings
    public function getUsersTable(){
        return $this->param['tblUsers'];
    }

}