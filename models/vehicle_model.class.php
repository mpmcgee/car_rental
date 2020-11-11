<?php
/**
 * Author: Matthew McGee
 * Date: 10/30/2020
 * File: toy_model.php
 *Description:
 */

class VehicleModel {
    private $db; //database object
    private $dbConnection; // database connection object
    private $tblVehicles;
    static private $_instance = NULL;

    public function __construct(){
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblVehicles = $this->db->getVehiclesTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one VehicleModel instance
    public static function getVehicleModel(){
        if (self::$_instance == NULL){
            self::$_instance = new VehicleModel();
        }
        return self::$_instance;

    }

    public function list_vehicle(){
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM tblVehicles";

        //execute the query
        $query = $this->dbConnection->query($sql);

        //if the query failed, return false
        if (!$query){
            return false;
        }

        //if the query succeeded, but no vehicle was found
        if($query->num_rows == 0){
            return 0;
        }

        //handle the result
        //crete an array to store all vehicles
        $vehicles = array();

        while($obj = $query->fetch_object()){

            //create a new vehicle object
            $vehicle = new Vehicle(stripslashes($obj->year), stripslashes($obj->make), stripslashes($obj->model),
                stripslashes($obj->engine_type), stripslashes($obj->transmission), stripslashes($obj->class),
                stripslashes($obj->doors), stripslashes($obj->line), stripslashes($obj->passengers), stripslashes($obj->suitcases),
                stripslashes($obj->combined_mpg), stripslashes($obj->sirius), stripslashes($obj->price_per_day));

            //set the id for the vehicle
            $vehicle->setId($obj->vehicle_id);

            //add the vehicle to the array
            $vehicles[] = $vehicle;
        }
        return $vehicles;

    }

    /*
    * the view_vehicle method retrieves the details of the vehicle specified by its id
    * and returns a vehicle object. Return false if failed.
    */

    public function view_vehicle()
    {

        //select sql statement
        $sql = "SELECT * FROM tblVehicles";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create a new vehicle object
            $vehicle = new Vehicle(stripslashes($obj->year), stripslashes($obj->make), stripslashes($obj->model),
                stripslashes($obj->engine_type), stripslashes($obj->transmission), stripslashes($obj->class),
                stripslashes($obj->doors), stripslashes($obj->line), stripslashes($obj->passengers), stripslashes($obj->suitcases),
                stripslashes($obj->combined_mpg), stripslashes($obj->sirius), stripslashes($obj->price_per_day));

            //set the id for the vehicle
            $vehicle->setId($obj->vehicle_id);

            return $vehicle;
        }

        return false;
    }

    public function search_vehicles($terms)
    {
        $terms = explode(" ", $terms); //explode multiple terms into an array

        //select statement for AND search
        $sql = "SELECT * FROM tblVehicles AND (1";

        foreach ($terms as $term) {
            $sql .= " AND year LIKE '%" . $term . "%' OR  make LIKE '%" . $term . "%' 
            OR model LIKE '%" . $term . "%' OR engine_type LIKE '%" . $term . "%' OR transmission LIKE '%" . $term . "%'
            OR class LIKE '%" . $term . "%' OR doors LIKE '%" . $term . "%' OR line LIKE '%" . $term . "%'
            OR passengers LIKE '%" . $term . "%' OR suitcases LIKE '%" . $term . "%' OR combined_mpg LIKE '%" . $term . "%'
            OR sirius LIKE '%" . $term . "%' OR price_per_day LIKE '%" . $term . "%'";


        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query) {
            return false;
        }

        if ($query->num_rows == 0) {
            return 0;
        }

        //handle the result
        //crete an array to store all vehicles
        $vehicles = array();

        while ($obj = $query->fetch_object()) {
            //create a new vehicle object
            $vehicle = new Vehicle(stripslashes($obj->year), stripslashes($obj->make), stripslashes($obj->model),
                stripslashes($obj->engine_type), stripslashes($obj->transmission), stripslashes($obj->class),
                stripslashes($obj->doors), stripslashes($obj->line), stripslashes($obj->passengers), stripslashes($obj->suitcases),
                stripslashes($obj->combined_mpg), stripslashes($obj->sirius), stripslashes($obj->price_per_day));

            //set the id for the vehicle
            $vehicle->setId($obj->vehicle_id);

            //add the vehicle to the array
            $vehicles[] = $vehicle;
        }
        return $vehicles;
    }



}