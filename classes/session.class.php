<?php

require_once 'register.class.php';
require_once 'database.class.php';

class session {

    //Log the user in. First checks to see if the 
    //username and password match a row in the database.
    //If it is successful, set the session variables
    //and store the user object within.
    public function login($email, $password) {


        $hashedPassword = md5($password);
        $result = mysql_query("SELECT * FROM users WHERE email = '$email' AND password = '$hashedPassword'");

        if (mysql_num_rows($result) == 1) {

            $db = new database();
            $result = $db->select('user', "email = $email");

            $arrayResult = $db->process($result, true);

            $_SESSION["user"] = serialize($this->get($email));
            $_SESSION["userRole"] = $arrayResult[0]['role'];
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            echo "helllllllllllllooo".$_SESSION;
            return true;
        } else {
            return false;
        }
    }

    //Log the user out. Destroy the session variables.
    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['userRole']);
        unset($_SESSION['login_time']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }

    //Check to see if a username exists.
    //This is called during registration to make sure all user names are unique.
    public function checkEmailExists($email) {
        $result = mysql_query("select email from user where email='$email'") or die(mysql_error());
        ;
        if (mysql_num_rows($result) == 0) {
            return false;
        } else {
            return true;
        }
    }

    //get a user
    //returns a User object. Takes the users id as an input
    public function get($email) {

        $db = new database();
        $result = $db->select('user', "email = $email");

        $arrayResult = $db->process($result, true);

        if ($arrayResult[0]['role'] == "student") {
            $result1 = $db->select('student', "email = $email");
            return new student($result1);
        } elseif ($arrayResult[0]['role'] == "employer") {
            $result2 = $db->select('employer', "email = $email");
            return new employer($result2);
        }
    }

}

?>