<?php

    require_once("../Calculations/SetDates.php");
    require_once("../Calculations/SessionVariables.php");

    //Authorisation
    if($_SESSION['UserAuth'] == false)
		header("Location: ../Login/Login.php");

?>

<html>

    <div class="row">

        <!-- Title -->
        <div class="col-6">
            <h1 class="text-left text-black font-italic ml-1">miniproject</h1>
        </div>

        <!-- Details -->
        <div class="col-6 text-dark text-right">
            <h6 class="mt-1"><?php echo date("d M Y", time()); ?></h6>
            <h6>Available: <?php echo "&pound;".$_SESSION['currentAvailable']; ?></h6>
        </div>

    </div>

</html>