<?php
/**
 * Author: Matthew McGee
 * Date: 11/9/2020
 * File: booking.class.php
 *Description:
 */

class Booking
{
    //private properties of a Booking object
    private $id, $customer_id, $last_name, $first_name, $vehicle_id, $vehicle_year, $vehicle_make, $vehicle_model, $start_date, $end_date;

    //constructor that initializes all properties
    public function __construct($customer_id, $last_name, $first_name, $vehicle_id, $vehicle_year,
                   $vehicle_make, $vehicle_model, $start_date, $end_date){
        $this->customer_id = $customer_id;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->vehicle_id = $vehicle_id;
        $this->vehicle_year = $vehicle_year;
        $this->vehicle_make = $vehicle_make;
        $this->vehicle_model = $vehicle_model;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getCustomerId()
    {
        return $this->customer_id;
    }


    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }


    public function getVehicleId()
    {
        return $this->vehicle_id;
    }


    public function getVehicleYear()
    {
        return $this->vehicle_year;
    }


    public function getVehicleMake()
    {
        return $this->vehicle_make;
    }


    public function getVehicleModel()
    {
        return $this->vehicle_model;
    }


    public function getStartDate()
    {
        return $this->start_date;
    }


    public function getEndDate()
    {
        return $this->end_date;
    }

    //set booking id
    public function setId($id){
        $this->id = $id;
    }


}