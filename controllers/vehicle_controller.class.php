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
        $this->vehicle_model = VehicleModel::getVehicleModel();
    }

    //list all vehicle
    public function index(){
        //retrieve all vehicle and store them in an array
        $vehicles = $this->vehicle_model->list_vehicle();

        //if there is no vehicle model, display error message
        if(!$vehicles){
            //display error
            $message = "There was a problem displaying vehicle.";
            $this->error($message);
            return;
        }

        //display all vehicle
        $view = new VehicleIndex();
        $view->display($vehicles);
    }

    //handle an error
    public function error($message)
    {

        //create an object of the error class
        $error = new VehicleError();

        //display error message
        $error->display($message);
    }

    // search vehicle
    public function search(){
        $query_terms = trim($_GET['query_terms']);

        //if search term is empty, list all vehicle
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching vehicle
        $vehicles = $this->vehicle_model->search_vehicles($query_terms);

        if($vehicles === false){
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matching vehicle
        $search = new VehicleSearch();
        $search->display($query_terms, $vehicles);



    }

    //handle calling inaccessible methods
    public function __call($name, $arguments)
    {
        //$message = "Route does not exist.";
        //Note: value of $name is case sensitive
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }
}