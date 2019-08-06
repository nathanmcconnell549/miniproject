<?php

    //Start Session
    session_start();
    
    //Create Error Array
    $_SESSION['errors'] = array();

    //Link to Validation Methods File
    require_once("../Validation/Validation.php");

    //Assign Variable Values
    if (isset($_POST['submit'])) {

        //Assign Values
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $monthlySalary = $_POST['monthlySalary'];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        //Validate First Name
        validateLettersOnly($firstName, "First Name");

        //Validate Surname
        validateLettersOnly($lastName, "Last Name");

        //Validate Email
        validateEmail($email);

        //Validate Amount
        validateCurrency($monthlySalary);

        //Validate Password
        validatePassword($password, $confirmPassword);

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: Registration.php");

        //Add User
        } else {
        
            //Add User Method
            addUser($firstName, $lastName, $email, $monthlySalary, $password);
			$_SESSION['UserAuth'] = true;
        }
    }

?>