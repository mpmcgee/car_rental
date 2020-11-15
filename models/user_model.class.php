<?php
/*
 * Author: Matthew McGee, Danny Harris, Coltin Espich
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



    public function add_user(){
        // REGISTER USER
        // receive all input values from the form
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $first_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $last_name = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $role = 2; //Role 2 = customer role.

        //SQL insert statement.
        $sql = "INSERT INTO " . $this->db->getUserTable() .
            " VALUES (NULL, '$first_name', '$last_name', '$username', '$password_hash', '$role', '$email')";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (is_null($query)) {
            return false;

            //set cookie with username and return true
        } else {
            //Create cookie for username.
            setcookie("login", $username);
            return true;
        }

    }


    public function verify_user()
    {
        //get credentials
        $username = ($_POST['username']);
        $password = ($_POST['password']);

        //sql select statement
        $sql = "Select * From " . $this->db->getUserTable() . " WHERE username = '$username'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if($query->num_rows > 0){
            //loop through all rows
            while ($query_row = $query->fetch_assoc()){

                //verify password
                if (password_verify($password, $query_row['password'])) {
                    setcookie("login", $username);
                    return true;
                }
            }
        }
        return false;
    }


    public function logout(){

        //if 'login' cookie is set, destroy it
        if (isset($_COOKIE['login'])) {
            unset($_COOKIE['login']);
            setcookie('login', null, -1, '/');
        }
        //if 'login' cookie is not set, return true
        if (isset($_COOKIE['login'])){
            return false;
        } else {
            return true;
        }
    }


    public function reset_password(){

        //retrieve credentials and table
        $username = $_POST['username'];
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $tbl = $this->db->getUserTable();

        //sql update statement
        $sql = "UPDATE $tbl SET password='$password_hash' WHERE username='$username'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query){
            return false;
        }

        else{
            return true;
        }
    }
}
