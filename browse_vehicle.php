<?php
/**
 * Author: Matthew McGee
 * Date: 10/26/2020
 * File: browse_vehicle.php
 *Description:
 */

require_once ("classes/vehicle.class.php");

$vehicle = new Vehicle;

//retrieve values selected
$details = explode(",", $_GET["details"]);

//retrieve class entered
$v_class = $details[0];

//retrieve line entered
$line = $details[1];

//retrieve objects from array with these parameters
$result = $vehicle->lookup($line, $v_class);