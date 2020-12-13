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
    private $tblUsers;

    public function __construct(){
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getUsersTable();
    }

    public function add_user(){
        try {
            // REGISTER USER
            // receive all input values from the form
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $first_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
            $last_name = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
            $role = 2; //Role 2 = customer role.
            
            //Check for missing data.
            if ($username == "" || $_POST['password'] == "" || $email == "" || $first_name == "" || $last_name == "") {
                throw new DataMissingException("Please complete all fields.");
            }

            //Check password length.
            if (strlen($_POST['password']) < 5) {
                throw new DataLengthException("Passwords must contain at least 5 characters.");
            }


            //SQL insert statement.
            $sql = "INSERT INTO " . $this->tblUsers .
                " VALUES (NULL, '$first_name', '$last_name', '$username', '$password_hash', '$role', '$email')";
            $sql2 = "SELECT * FROM " . $this->tblUsers . " WHERE  username = '$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            //execute the query and return true if successful or false if failed
            if (!$query) {
                throw new DatabaseException("There was an error adding user to the database.");
            } else if ($this->dbConnection->query($sql2) > 0){
                throw new DatabaseException("Username already taken.");
            }
            
            } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DataLengthException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) { //Handle all other exceptions.
            return $e->getMessage();
        }
        //If no errors, return success message.
        //Create cookie for username.
        setcookie("login", $username);
        return "You have successfully registered.";
    }
    
    public function verify_user()
    {
        $login_status = "";
        try {
            //get credentials
            $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
            $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

            //Check for missing data.
            if ($username == "" || $password == "") {
                throw new DataMissingException("Please enter both a username and password.");
            }

            //sql select statement
            $sql = "Select password, role From " . $this->tblUsers . " WHERE username = '$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);
            
            //execute the query and return true if successful or false if failed
            if (!$query || $query->num_rows == 0) {
                throw new DatabaseException("There was an error verifying the account exists.");
            }

            //Verify the username and password are correct.
            if ($query->num_rows > 0) {
                $query_row = $query->fetch_assoc();
                if (password_verify($password, $query_row['password'])) {
                    setcookie("login", $username);
                    $role = $query_row['role'];
                    session_start();

                    $_SESSION['role'] = $role;

                    //If no errors, verify password and return success message.
                    return "You have successfully logged in.";
                } else {
                    throw new DatabaseException("There was an error verifying the password.");
                }
            }
            
            } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function logout(){

        //if 'login' cookie is set, destroy it
        if (isset($_COOKIE['login'])) {
            unset($_COOKIE['login']);
            setcookie('login', null, -1, '/');
            session_start();
            session_destroy();
        }
        //if 'login' cookie is not set, return true
        if (isset($_COOKIE['login'])){
            return false;
        } else {
            return true;
        }
    }
    
    public function reset_password()
    {
        try {
            //retrieve credentials and table
            $username = $_POST['username'];
            $new_password = $_POST['password'];
            $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

            //Check for missing data.
            if ($_POST['password'] == "") {
                throw new DataMissingException("Please fill in the new password field.");
            }

            //Check password length.
            if (strlen($_POST['password']) < 5) {
                throw new DataLengthException("Password must contain at least 5 characters.");
            }



            //sql update statement
            $sql = "UPDATE " . $this->tblUsers . " SET password='$password_hash' WHERE username='$username'";

            //sql statement to check to see if password is new
            $sql2 = "SELECT password FROM " . $this->tblUsers . " WHERE username='$username'";


            //execute the query
            $query2 = $this->dbConnection->query($sql2);


            // check to see if password has been used before
            if ($query2 && $query2->num_rows > 0) {
                $result_row = $query2->fetch_assoc();
                $hash = $result_row['password'];
                if (password_verify($new_password, $hash)) {
                    throw new DatabaseException("Password previously used.");
                }
            }

            //execute the query
            $query = $this->dbConnection->query($sql);



            //execute the query and return true if successful or false if failed
            if (!$query) {
                throw new DatabaseException("There was an error updating the password.");
            }


        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DataLengthException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) { //Handle all other exceptions.
            return $e->getMessage();
        }
        //If no errors, return success message.
        return "Your password has been successfully reset.";
    }
}
