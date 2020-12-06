<?php
/**
 * Author: Matthew McGee
 * Date: 11/1/2020
 * File: vehicle.class.php
 *Description:
 */

class Vehicle
{
    //private properties of a vehicle object
    private $id, $year, $make, $model, $engine_type, $transmission, $class,
        $doors, $line, $passengers, $suitcases, $combined_mpg, $sirius, $price_per_day;

    //constructor that initializes vehicle properties
    public function __construct($year, $make, $model, $engine_type, $transmission, $class,
            $doors, $line, $passengers, $suitcases, $combined_mpg, $sirius, $price_per_day){


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
    }


    public function getId()
    {
        return $this->id;
    }


    public function getYear()
    {
        return $this->year;
    }

    public function getMake()
    {
        return $this->make;
    }


    public function getModel()
    {
        return $this->model;
    }


    public function getEngineType()
    {
        return $this->engine_type;
    }


    public function getTransmission()
    {
        return $this->transmission;
    }


    public function getClass()
    {
        return $this->class;
    }


    public function getDoors()
    {
        return $this->doors;
    }


    public function getLine()
    {
        return $this->line;
    }


    public function getPassengers()
    {
        return $this->passengers;
    }


    public function getSuitcases()
    {
        return $this->suitcases;
    }


    public function getMpg()
    {
        return $this->combined_mpg;
    }


    public function getSirius()
    {
        return $this->sirius;
    }


    public function getPrice()
    {
        return $this->price_per_day;
    }

    //set vehicle id
    public function setId($id){
        $this->id = $id;
    }


}