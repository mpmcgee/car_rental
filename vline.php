<?php
/**
 * Author: Matthew McGee
 * Date: 12/7/2020
 * File: vline.php
 *Description:
 */

//retrieve class selection
$line = ($_GET['vLine']);

// establish database connection and get tables for bookings and vehicles
$db = Database::getDatabase();
$this->dbConnection = $this->db->getConnection();
$this->tblBookings = $this->db->getBookingsTable();
$this->tblVehicles = $this->db->getVehiclesTable();




$start_date = (filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_STRING));
$end_date = (filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_STRING));




$sql = "SELECT * FROM " . $this->tblBookings . "," . $this->tblVehicles . " WHERE " .
    $this->tblBookings . ".vehicle_id=" . $this->tblVehicles . ".vehicle_id AND " . $this->tblVehicles . ".line='$line' AND
    ('$start_date' NOT BETWEEN " . $this->tblBookings . ".start_date AND " . $this->tblBookings . ".end_date) AND
    ('$end_date' NOT BETWEEN " . $this->tblBookings . ".start_date AND " . $this->tblBookings . ".end_date)";


//execute the query
    $query = $this->dbConnection->query($sql);


//create an array to store all returned vehicles
    $results = array();

    if ($query && $query->num_rows > 0) {

        //loop through all rows and crete recordsets
        while ($obj = $query->fetch_object()) {

                $vehicle = new Vehicle(stripslashes($obj->year), stripslashes($obj->make), stripslashes($obj->model),
                    stripslashes($obj->engine_type), stripslashes($obj->transmission), stripslashes($obj->class),
                    stripslashes($obj->doors), stripslashes($obj->line), stripslashes($obj->passengers), stripslashes($obj->suitcases),
                    stripslashes($obj->combined_mpg), stripslashes($obj->sirius), stripslashes($obj->price_per_day));

                //set the id for the booking
                $vehicle->setId($obj->vehicle_id);


                //add the booking to the array
                $results[] = $vehicle;
            }


        }

        echo json_encode($results);








