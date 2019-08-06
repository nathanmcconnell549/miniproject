<?php

    //Require DB
    require_once("../DB/dbConn.php");

    //Get + Set Transaction ID
    $id = $_REQUEST['id'];
    $row = getRow($id);

    //Delete Player
    deleteTransaction($id);

    //Display Expenses
    header("Location: ViewExpenses.php");

?>