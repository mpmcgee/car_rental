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
        try {

            $sql = "SELECT * FROM . " . $this->tblVehicles;

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the vehicle(s) exists.");
            }

            //if the query failed, return false
            if (!$query) {
                return false;
            }

            //if the query succeeded, but no vehicle was found
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

        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        }

    /*
    * the view_vehicle method retrieves the details of the vehicle specified by its id
    * and returns a vehicle object. Return false if failed.
    */

    public function view_vehicle()
    {
        try {
            //select sql statement
            $sql = "SELECT * FROM" . $this->tblVehicles;

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the vehicle(s) exists.");
            }

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
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        }

    //the vehicle method updates an existing vehicle in the database. Details of the vehicle are posted in a form. Return true if succeed; false otherwise.
    public function update_vehicle($id) {
        try {
            //if the script did not received post data, display an error message and then terminate the script immediately
            if (!filter_has_var(INPUT_POST, 'year') ||
                !filter_has_var(INPUT_POST, 'make') ||
                !filter_has_var(INPUT_POST, 'model') ||
                !filter_has_var(INPUT_POST, 'engine-type') ||
                !filter_has_var(INPUT_POST, 'transmission') ||
                !filter_has_var(INPUT_POST, 'class') ||
                !filter_has_var(INPUT_POST, 'doors') ||
                !filter_has_var(INPUT_POST, 'line') ||
                !filter_has_var(INPUT_POST, 'passengers') ||
                !filter_has_var(INPUT_POST, 'suitcases') ||
                !filter_has_var(INPUT_POST, 'combined-mpg') ||
                !filter_has_var(INPUT_POST, 'sirius') ||
                !filter_has_var(INPUT_POST, 'price_per_day')) {

                return false;
            }

            //retrieve data for the new movie; data are sanitized and escaped for security.
            $year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING)));
            $make = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING)));
            $model = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'model', FILTER_DEFAULT));
            $engine_type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'engine-type', FILTER_SANITIZE_STRING)));
            $transmission = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'transmission', FILTER_SANITIZE_STRING)));
            $class = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING)));
            $doors = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'doors', FILTER_SANITIZE_STRING)));
            $line = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'line', FILTER_SANITIZE_STRING)));
            $passengers = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'passengers', FILTER_SANITIZE_STRING)));
            $suitcases = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'suitcases', FILTER_SANITIZE_STRING)));
            $combined_mpg = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'combined_mpg', FILTER_SANITIZE_STRING)));
            $sirius = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'sirius', FILTER_SANITIZE_STRING)));
            $price_per_day = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price_per_day', FILTER_SANITIZE_STRING)));

            //Check for missing data.
            if ($year == "" || $make == "" || $model == "" || $engine_type == "" ||
                $transmission == "" || $class == "" || $doors == "" || $line == "" || $passengers == "" || $suitcases == "" ||
                $combined_mpg == "" || $sirius == "" || $price_per_day == "") {
                throw new DataMissingException("Missing data.");
            }

            //query string for update
            $sql = "UPDATE " . $this->tblVehicles .
                " SET year='$year', make='$make', model='$model', engine_type='$engine_type', "
                . "transmission='$transmission', class='$class', doors='$doors', line='$line', passengers='$passengers',
                 suitcases='$suitcases, combined_mpg ='$combined_mpg', sirius='$sirius', price_per_day='$price_per_day', 'WHERE vehicle_id='$id'";

            //execute the query
            return $this->dbConnection->query($sql);

        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //the add booking method a new booking to the database. Details of the booking are posted in a form. Return true if succeed; false otherwise.
    public function add_vehicle() {
        try {
            //if the script did not received post data, display an error message and then terminate the script immediately
            if (!filter_has_var(INPUT_POST, 'year') ||
                !filter_has_var(INPUT_POST, 'make') ||
                !filter_has_var(INPUT_POST, 'model') ||
                !filter_has_var(INPUT_POST, 'engine-type') ||
                !filter_has_var(INPUT_POST, 'transmission') ||
                !filter_has_var(INPUT_POST, 'class') ||
                !filter_has_var(INPUT_POST, 'doors') ||
                !filter_has_var(INPUT_POST, 'line') ||
                !filter_has_var(INPUT_POST, 'passengers') ||
                !filter_has_var(INPUT_POST, 'suitcases') ||
                !filter_has_var(INPUT_POST, 'combined-mpg') ||
                !filter_has_var(INPUT_POST, 'sirius') ||
                !filter_has_var(INPUT_POST, 'price_per_day')) {

                return false;
            }


            //retrieve data for the new vehicle; data are sanitized and escaped for security.
            $year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING)));
            $make = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING)));
            $model = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'model', FILTER_DEFAULT));
            $engine_type = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'engine-type', FILTER_SANITIZE_STRING)));
            $transmission = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'transmission', FILTER_SANITIZE_STRING)));
            $class = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING)));
            $doors = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'doors', FILTER_SANITIZE_STRING)));
            $line = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'line', FILTER_SANITIZE_STRING)));
            $passengers = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'passengers', FILTER_SANITIZE_STRING)));
            $suitcases = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'suitcases', FILTER_SANITIZE_STRING)));
            $combined_mpg = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'combined_mpg', FILTER_SANITIZE_STRING)));
            $sirius = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'sirius', FILTER_SANITIZE_STRING)));
            $price_per_day = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price_per_day', FILTER_SANITIZE_STRING)));

            //Check for missing data.
            if ($year == "" || $make == "" || $model == "" || $engine_type == "" ||
                $transmission == "" || $class == "" || $doors == "" || $line == "" || $passengers == "" || $suitcases == "" ||
                $combined_mpg == "" || $sirius == "" || $price_per_day == "") {
                throw new DataMissingException("Missing data.");
            }

            //query string for update
            $sql = "INSERT INTO " . $this->tblVehicles .
                " VALUES (NULL, '$year', '$make', '$model', '$engine_type', 
                '$transmission', '$class', '$doors', '$line', '$passengers',
                 '$suitcases', '$combined_mpg', '$sirius', '$price_per_day')";


            //execute the query
            $query = $this->dbConnection->query($sql);

            if (is_null($query)) {
                return false;

                //set cookie with username and return true
            } else {

                return true;
            }
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function search_vehicles($terms)
    {
        try {
            $terms = explode(" ", $terms); //explode multiple terms into an array

            //Check for missing data.
            if ($terms == "") {
                throw new DataMissingException("Please enter a vehicle.");
            }

            if (in_array("VLINE", $terms)) {
                //select statement for AND search
                $sql = "SELECT * FROM " . $this->tblVehicles . " WHERE (";

                $sql .= "class = '" . $terms[0] . "' AND line = '" . $terms[1] . "'";
            } else {

                //select statement for AND search
                $sql = "SELECT * FROM " . $this->tblVehicles . " WHERE (1";
                
                foreach ($terms as $term) {
                    $sql .= " AND year LIKE '%" . $term . "%' OR  make LIKE '%" . $term . "%' 
                OR model LIKE '%" . $term . "%' OR engine_type LIKE '%" . $term . "%' OR transmission LIKE '%" . $term . "%'
                OR class LIKE '%" . $term . "%' OR doors LIKE '%" . $term . "%' OR line LIKE '%" . $term . "%'
                OR passengers LIKE '%" . $term . "%' OR suitcases LIKE '%" . $term . "%' OR combined_mpg LIKE '%" . $term . "%'
                OR sirius LIKE '%" . $term . "%' OR price_per_day LIKE '%" . $term . "%'";
                    
                    }
            }

            $sql .= ")";


            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the vehicle exists.");
            }

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
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
            
                
