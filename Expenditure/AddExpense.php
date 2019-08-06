<?php

    //Start Session
    session_start();

    $_SESSION['ExpenseTypes'] = array('Groceries', 'Travel', 'Eating Out', 'Entertainment', 'Home', 'Other');

?>

<html>

<head>

    <title>Add Expense</title>
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

                        <h4 class="text-center mt-2 mb-2">Add Expense</h4>

                    </div>

                    <div class="card-body bg-white">
                
                        <form action="ValidateExpense.php" method="POST">

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
                                <input type="date" class="form-control" name="date" max=<?php echo date('Y-m-d');?>>
                            </div>
                                
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Description">
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label><br>
                                <select name="type">
                                    <?php foreach($_SESSION['ExpenseTypes'] as $expenseType) echo "<option>$expenseType</option>" ?>
                                </select>
                            
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount (£)</label>
                                <input type="number" step="any" class="form-control" name="amount" placeholder="">
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