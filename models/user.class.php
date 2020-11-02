<?php
/**
 * Author: Coltin Espich
 * Date: 10-29-2020
 * File: user.class.php
 *Description: Define the user object for creating users.
 */

require_once ("application/database.class.php");


class User {
    //Object Attributes.
    private $id, $first_name, $last_name, $username, $password, $role, $phone, $email;

    //Constructor.
    public function __construct($first_name, $last_name, $username, $password, $role, $phone, $email) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->phone = $phone;
        $this->email = $email;
    }

    //Set user id.
    public function setId($id) {
        $this->id = $id;
    }

    //Get user id.
    public function getId() {
        return $this->id;
    }

    //Get user first name.
    public function getFirstname() {
        return $this->first_name;
    }

    //Get user last name.
    public function getLastname() {
        return $this->last_name;
    }

    //Get username.
    public function getUsername() {
        return $this->username;
    }

    //Get password.
    public function getPassword() {
        return $this->password;
    } 
} 
