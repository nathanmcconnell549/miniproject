<?php

    session_start();

    require_once("../DB/dbConn.php");
    require_once("../Validation/Validation.php");

    unset($_SESSION['dateFrom']);   
    unset($_SESSION['dateTo']); 
    unset($_SESSION['searchType']);  

    //Submit Clicked
    if(isset($_POST['searchButton'])){

        //Dates
        if (isset($_POST['searchDates'])) {

            //Date From
            if(!validateDate($_POST['dateFrom'])) {

                $error = "Invalid Date From";
                array_push($_SESSION['errors'], $error);

            } else {

                //Assign Date From
                $_SESSION['dateFrom'] = $_POST['dateFrom'];

                //Date To
                if(!validateDate($_POST['dateTo'])) {

                    $error = "Invalid Date To";
                    array_push($_SESSION['errors'], $error);

                } else {

                    //Assign Date To
                    $_SESSION['dateTo'] = $_POST['dateTo'];

                }     
            }
        }

        //Type
        if (isset($_POST['searchType'])) {

            //Assign Search Type
            $_SESSION['searchType'] = $_POST['type'];
        }

        //Refresh View Expenses
        header("Location: ViewExpenses.php");
            
    } 
?>