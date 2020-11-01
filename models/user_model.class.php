<?php
/**
 * Author: Matthew McGee
 * Date: 10/30/2020
 * File: user_model.class.php
 *Description:
 */


class UserModel
{

    private $db; //database object
    private $dbConnection; // database connection object

    public function __construct(){
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
    }



    public function add_user()
    {
        // REGISTER USER
        if (isset($_POST['submit'])) {
            // receive all input values from the form
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $first_name = filter_var(['first_name'], FILTER_SANITIZE_STRING);
            $last_name = filter_var(['last_name'], FILTER_SANITIZE_STRING);
        }
        if (empty($username)) {

            return false;

        } else if (empty($password)) {

            return false;

        } else if (empty($email)) {

            return false;

        } else if (empty($first_name)) {

            return false;

        } else if (empty($last_name)) {

            return false;

        } else {
            $sql = ("INSERT INTO" . $this->db->getUserTable() . "(username, password, email, first_name, last_name) 
            VALUES ('$username', '$password_hash', '$email', '$first_name', '$last_name'");


            if ($this->dbConnection->query($sql)) {

                return true;
            } else {

                return false;
            }
        }

    }
    public function verify_user(){
        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            //sql select statement
            $sql = "SELECT * FROM" . $this->db->getUserTable() . "WHERE username = '$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0){
                //array to store credentials from db
                $credentials = array();

                //loop through all rows
                while ($query_row = $query->fetch_assoc()) {
                    $credential = new User($query_row["username"],
                        $query_row["password"]);

                    //push credential into the array
                    $credentials[] = $credential;
                }
            } if ($username == $credentials["username"] and password_verify($password, $credentials["password"])){
                setcookie("login", $_REQUEST["username"]);

            } else{
                return false;
            }
        } else{

            return false;
        }
    }

    public function logout(){
        setcookie('login', '', time()-70000000000, '/');
    }

    public function reset_password(){
        if (isset($_COOKIE['login'])){
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $password = $_POST['username'];
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                //sql select statement
                $sql = "UPDATE" . $this->db->getUserTable() .
                    "SET password = '$password_hash' where username = '$username'";

                if ($this->dbConnection->query($sql) === TRUE){
                    return true;
                }

                else{
                    return false;
                }


            }
        } else{
            return false;
        }
    }

}