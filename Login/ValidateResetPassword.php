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
        $confirmPassword = $_POST['confirmPassword'];

        //Validate Existing User
        if(existingUsernameCheck($email) != true)
            array_push($_SESSION['errors'], "Username doesn't exist");
        else {

            //Validate Passwords Match
            validatePassword($password, $confirmPassword);

            //Change Password on DB
            updatePassword($email, $password);
        }

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: ResetPassword.php");

        //Login
        } else {
        
            //Login
            $_SESSION['UserID'] = getUserID($email);
            header("Location: Login.php");
            
        }
    }

?>