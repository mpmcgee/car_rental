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
    private $vehicle_id, $year, $make, $model, $engine_type, $transmission, $class,
        $doors, $line, $passengers, $suitcases, $combined_mpg, $sirius, $price_per_day;

    //constructor that initializes vehicle properties
    public function __construct($vehicle_id, $year, $make, $model, $engine_type, $transmission, $class,
            $doors, $line, $passengers, $suitcases, $combined_mpg, $sirius, $price_per_day){

        $this->vehicle_id = $vehicle_id;
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

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->vehicle_id;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getEngineType()
    {
        return $this->engine_type;
    }

    /**
     * @return mixed
     */
    public function getTransmission()
    {
        return $this->transmission;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return mixed
     */
    public function getDoors()
    {
        return $this->doors;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return mixed
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * @return mixed
     */
    public function getSuitcases()
    {
        return $this->suitcases;
    }

    /**
     * @return mixed
     */
    public function getMpg()
    {
        return $this->combined_mpg;
    }

    /**
     * @return mixed
     */
    public function getSirius()
    {
        return $this->sirius;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price_per_day;
    }


}