<?php
/**
 * Author: Matthew McGee
 * Date: 10/31/2020
 * File: vehicle_controller.class.php
 *Description:
 */

class VehicleController
{
    //attributes
    private $vehicle_model;

    public function __construct(){

        //crete an object of the VehicleModel class
        $this->vehicle_model = new VehicleModel();
    }

    //list all vehicles
    public function all(){
        //retrieve all vehicles and store them in an array
        $vehicles = $this->vehicle_model->getVehicles();

        //if there is no vehicle model, display error message
        if(!$vehicles){
            header("Location: browse.php?action=error&message=No vehicle was found.");
            exit();
        }

        //crete a new object of the VehicleView class
        $view = new VehicleView();

        //display all vehicles
        $view->display($vehicles);
    }

    public function error($message){

        //create an object of the error class
        $error = new VehicleError();

        //display the error message
        $error->display($message);
    }
}