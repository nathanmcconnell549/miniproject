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
        $date = $_POST['date'];
        $description = $_POST["description"];
        $amount = $_POST["amount"];

        //Validate Date
        if(validateDate($date) === false)
            array_push($_SESSION['errors'], "Date is invalid");

        //Validate Description
        validateLettersOnly($description, "Description");

        //Validate Amount
        validateCurrency($amount);

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: AddIncome.php");

        //Add User
        } else {
        
            //Add Other Income
            addTransaction($_SESSION['UserID'], $date, $description, "OtherIncome", $amount);

            //View Income
            header("Location: ViewIncome.php");
        }
    }

?>