<?php

    session_start();

    require_once("../DB/dbConn.php");
    $id = $_REQUEST['id'];
    $row = getRow($id);

    //Delete Bill
    if(deleteTransaction($id) === true)
        header("Location: ViewBills.php");
    

?>