<?php

    //Start Session
    session_start();

    require_once("../DB/dbConn.php");
    require_once("../Validation/Validation.php");
    $id = $_REQUEST['id'];
    $row = getRow($id);

    //Submit Clicked
    if(isset($_POST['submit'])){

        //Assign Values
        $date = $_POST["date"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];

        //Run Validation Methods
        validateEditTransaction($date, $description, $amount);

        //Update
        if(empty($_SESSION['errors'])) {

            //Edit Other Income
            if(editTransaction(date("Y-m-d", time()), $description, "OtherIncome", $amount, $id) === true)
                header("Location: ViewIncome.php");
        } 
    }

?>

<html>

<head>

    <title>Edit Regular Income</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body class="bg-white">    

    <div class="container-fluid bg-white">

        <!-- Header -->
        <?php require_once("../HTMLSnippets/header.php") ?>

        <!-- Nav Bar -->
        <?php require_once("../HTMLSnippets/navbar.php") ?>

        <div class="row">

            <div class="col-4 mb-5"></div>

            <div class="col-4 mb-5">

                <div class="card bg-white align-center mt-5">

                    <div class="card-head bg-light">

                        <h4 class="text-center mt-2 mb-2">Edit Regular Income</h4>

                    </div>

                    <div class="card-body bg-white">
                
                        <form action="" method="POST">

                            <?php if(isset($_SESSION['errors'])): ?>
                                <div class="font-italic">
                                    <?php 
                                        foreach($_SESSION['errors'] as $error) {
                                            echo "<li>$error</li><br>";
                                            $_SESSION['errors'] = array();
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" value="<?php echo $row['Date']; ?>" name="date">
                            </div>
                                
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" value="<?php echo $row['Description']; ?>" name="description" placeholder="Description">
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount (£)</label>
                                <input type="number" step="any" class="form-control" value="<?php echo $row['Amount']; ?>" name="amount" placeholder="">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="mt-2">Submit</button>
                            </div>
                            
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>