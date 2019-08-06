<?php

    //Destroy Session Variables
    session_destroy();

    //Display Login Page
    header("Location: ../Login/Login.php");

?>