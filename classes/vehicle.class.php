<?php
/**
 * Author: Matthew McGee
 * Date: 10/24/2020
 * File: vehicle.class.php
 *Description:
 */

class Vehicle
{

    //private data members of Vehicle object
    private $id, $year, $make, $model, $engine_type, $transmission,
        $class, $doors, $line, $passengers, $suitcases, $combined_mpg, $sirius, $price_per_day;

    //constructor to initialize vehicle attributes

    public function __construct(string $year, string $make, string $model, string $engine_type,
                                string $transmission, string $class, string $doors, string $line, string $passengers,
                                string $suitcases, string $combined_mpg, string $sirius, string $price_per_day, string $image){

        $this->year = $year;
        $this->make = $make;
        $this->model = $model;
        $this->engine_type = $engine_type;
        $this->transmission = $transmission;
        $this->class = $class;
        $this->doors = $doors;
        $this->line = $line;
        $this->passengers = $passengers;
        $this->suitcases = $suitcases;
        $this->combined_mpg = $combined_mpg;
        $this->sirius = $sirius;
        $this->price_per_day = $price_per_day;
        $this->image = $image;
    }

    //get the id of a vehicle
    public function getID():int {
        return $this->id;
    }

    //get the year of the vehicle
    public function getYear():string {
        return $this->year;
    }

    //get the make of the vehicle
    public function getMake():string {
        return $this->make;
    }

    //get the model of the vehicle
    public function getModel():string {
        return $this->model;
    }

    //get the engine type of the vehicle
    public function getEngine():string {
        return $this->engine_type;
    }

    //get the transmission type of the vehicle
    public function getTransmission():string {
        return $this->transmission;
    }

    //get the class of the vehicle
    public function getClass():string {
        return $this->class;
    }

    //get the doors of the vehicle
    public function getDoors():string {
        return $this->doors;
    }

    //get the line of the vehicle
    public function getLine():string {
        return $this->line;
    }

    //get the passengers of the vehicle
    public function getPassengers():string {
        return $this->passengers;
    }

    //get the suitcases of the vehicle
    public function getSuitcases():string {
        return $this->suitcases;
    }

    //get the sirius capability of the vehicle
    public function getSirius():string {
        return $this->sirius;
    }

    //get the price per day capability of the vehicle
    public function getPrice():string {
        return $this->price_per_day;
    }

    // Get the image file name and path of a vehicle
    public function getImage():string {
        return $this->image;
    }

    //set vehicle id
    public function setID(int $id) {
        $this->id = $id;
    }


}