<?php
/**
 * Author: Matthew McGee, Danny Harris
 * Date: 10/24/2020
 * File: database.class.php
 *Description:
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'rental',
        'tblVehicle' => 'vehicles',
    );

    //define the database connection object
    private $objConnection = NULL;
    static private $_instance = NULL;

    //private constructor
    private function __construct(){
        $this->objConnection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );
        if (mysqli_connect_errno() != 0){
            echo "Failed to connect to database: ", mysqli_connect_error(), ".";
            exit();
        }
    }

    //static method to ensure only one Database instance
    static public function getDatabase(){
        if (self::$_instance == NULL)
            self::$_instance = new Database;
        return self::$_instance;
    }

    //function to return the database connection object
    public function getConnection(){
        return $this->objConnection;
    }

    //returns name of table that stores vehicles
    public function getVehiclesTable(){
        return $this->param['tblVehicle'];
    }

}