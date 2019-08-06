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
        $date = $_POST["date"];
        $description = $_POST["description"];
        $type = $_POST["type"];
        $amount = $_POST["amount"];

        //Validate Date
        validateDate($date);

        //Validate Description
        validateLettersOnly($description, "Description");

        //Validate Amount
        validateCurrency($amount);

        //Output Errors
        if (!empty($_SESSION['errors'])) {

            //Display Errors
            header("Location: AddExpense.php");

        //Add User
        } else {
        
            //Add Expense
            addTransaction($_SESSION['UserID'], $date, $description, $type, $amount);

            //View Expense
            header("Location: ViewExpenses.php");
        }
    }

?>