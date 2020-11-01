<?php
/**
 * Author: Matthew McGee
 * Date: 11/1/2020
 * File: index.php
 *Description:
 */

require 'vendor/autoload.php';

$vehicle_controller = new VehicleController();

//default action is list all vehicles
$action = "all";
if(isset($_GET['action']) && !(empty($_GET['action'])))
    $action = $_GET['action'];

//invoke appropriate method depending on action value
if($action === "all"){
    $vehicle_controller->all();
} else if ($action === "error"){
    //default error message
    $message = "We are sorry, but an error has occurred.";
    //retrieve the error message
    if ((isset($_GET['message'])) && (!empty($_GET['message'])))
        $message = $_GET['message'];
    $vehicle_controller->error($message);
}

else {
    $message = "Invalid action was requested.";
    $vehicle_controller->error($message);
}