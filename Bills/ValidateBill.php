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
        $description = $_POST["description"];
        $amount = $_POST["amount"];

        //Validate Description
        validateLettersOnly($description, "Description");

        //Validate Amount
        validateCurrency($amount);

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: AddBill.php");

        //Add User
        } else {
        
            //Assign Variables
            $UserID = $_SESSION['UserID'];
            $date = date("Y-m-d", time());

            //Add Bill
            addTransaction($UserID, $date, $description, "Bills", $amount);

            //View Bill
            header("Location: ViewBills.php");
        }
    }

?>