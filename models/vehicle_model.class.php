<?php
/**
 * Author: Matthew McGee
 * Date: 10/30/2020
 * File: toy_model.php
 *Description:
 */

class VehicleModel
{
    private $db; //database object
    private $dbConnection; // database connection object

    public function __construct(){
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
    }

    /*
 * this method retrieves all toys from the database and
 * returns an array of Toy objects if successful or false if failed.
 */
    public function getVehicles() {
        //SQL select statement
        $sql = "SELECT * FROM " . $this->db->getVehiclesTable();

        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            //array to store all toys
            $vehicles = array();

            //loop through all rows
            while ($query_row = $query->fetch_assoc()) {
                $vehicle = new Vehicle($query_row["vehicle_id"],
                    $query_row["year"],
                    $query_row["make"],
                    $query_row["model"],
                    $query_row["engine_type"],
                    $query_row["transmission"],
                    $query_row["class"],
                    $query_row["doors"],
                    $query_row["line"],
                    $query_row["passengers"],
                    $query_row["suitcases"],
                    $query_row["combined_mpg"],
                    $query_row["sirius"],
                    $query_row["price_per_day"]);

                //push the toy into the array
                $vehicles[] = $vehicle;
            }
            return $vehicles;
        }
        return false;
    }
}