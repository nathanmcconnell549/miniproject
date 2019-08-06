<?php

    //Session
    session_start();

    //Connect DB
    require_once("../DB/dbConn.php");

    //Get ID
    $id = $_REQUEST['id'];
    $row = getRow($id);

    //Delete Transaction
    if(deleteTransaction($id) === true)
        header("Location: ViewIncome.php");
    
?>