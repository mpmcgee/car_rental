<?php
/**
 * Author: Matthew McGee
 * Date: 10/26/2020
 * File: vehicle_manager.class.php
 *Description:
 */

require_once ("application/database.class.php");
require_once ("vehicle.class.php");

class VehicleManager
{
    //private data members
    private $db, $dbConnection;
    private $tblVehicles, $tblBookings;
    static private $_instance = NULL;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblVehicles = $this->db->getVehiclesTable();
        $this->tblBookings = $this->db->getBookingsTable();


        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one VehicleManager instance
    public static function getVehicleManager() {
        if (self::$_instance == NULL) {
            self::$_instance = new VehicleManager();
        }
        return self::$_instance;
    }

    /*
     * the listVehicles method retrieves all movies from the database and
     * returns an array of Movie objects if successful or false if failed.
     */

    public function list_vehicles(){
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblVehicles . "," . $this->tblBookings .
            " WHERE " . $this->tblVehicles . ".vehicle_id=" . $this->tblBookings . ".vehicle_id";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no movie was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned movies
        $vehicles = array();


        //loop through all rows in the returned record sets
        while ($obj = $query->fetch_object()){
            $vehicle = new Vehicle(stripslashes($obj->year), stripslashes($obj->make), stripslashes($obj->model),
                stripslashes($obj->engine_type), stripslashes($obj->transmission), stripslashes($obj->class),
                stripslashes($obj->doors), stripslashes($obj->line), stripslashes($obj->pasengers),
                stripslashes($obj->suitcases), stripslashes($obj->combined_mpg), stripslashes($obj->sirius),
                stripslashes($obj->price_per_day), stripslashes($obj->image));

            //set the id for the movie
            $vehicle->setId($obj->id);

            //add the movie to the array
            $vehicles[]=$vehicle;
        }
        return $vehicles;
    }

}