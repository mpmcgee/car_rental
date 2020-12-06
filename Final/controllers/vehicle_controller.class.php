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
            $message = "There was a problem displaying vehicles.";
            $this->error($message);
            return;
        }

        //display all vehicle
        $view = new VehicleIndex();
        $view->display($vehicles);
    }

    //show details of a vehicle
    public function detail($id) {
        //retrieve the specific vehicle
        $vehicle = $this->vehicle_model->view_vehicle($id);

        if (!$vehicle) {
            //display an error
            $message = "There was a problem displaying the vehicle id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display vehicle details
        $view = new VehicleDetail();
        $view->display($vehicle);
    }

    //display a vehicle in a form for editing
    public function edit($id)
    {
        //retrieve the specific movie
        $vehicle = $this->vehicle_model->view_vehicle($id);

        if (!$vehicle) {
            //display an error
            $message = "There was a problem displaying the vehicle id='" . $id . "'.";
            $this->error($message);
            return;
        }
    }

    //Register - store user information in database.
    public function new_vehicle()
    {
        $vehicle = $this->vehicle_model->add_vehicle();

        //If return value is false, return an error.
        if ($vehicle == False) {
            $message = "There was an error booking the vehicle.";
            $this->error($message);
            return;
        }

        $message = "Vehicle successfully created.";
        $view = new Vehicle();
        $view->display($message);
    }

    //update a vehicle in the database
    public function update($id) {
        //update the vehicle
        $update = $this->vehicle_model->update_vehicle($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the vehicle id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updated vehicle details
        $confirm = "The vehicle was successfully updated.";
        $vehicle = $this->vehicle_model->view_vehicle($id);

        $view = new VehicleDetail();
        $view->display($vehicle, $confirm);
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