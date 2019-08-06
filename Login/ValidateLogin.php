<?php

    //Start Session
    session_start();
    
    //Create Error Array
    $_SESSION['errors'] = array();

    //Require Validation Methods File
    require_once("../Validation/Validation.php");

    //Require DB Conn File
    require_once("../DB/dbConn.php");

    //Assign Variable Values
    if (isset($_POST['submit'])) {

        //Assign Values
        $email = $_POST["username"];
        $password = $_POST["password"];

        //Username And Password Check
        validateUsernameAndPasswordMatch($email, $password);

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: Login.php");

        //Login
        } else {
        
            //Login
            $_SESSION['UserID'] = getUserID($email);
            $_SESSION['UserAuth'] = true;
            header("Location: ../Home/Home.php");
            
        }
    }

?>