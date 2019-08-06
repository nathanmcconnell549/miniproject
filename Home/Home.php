<?php 

	//Start Session
	session_start();

?>

<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body class="text-center">    

    <div class="container-fluid bg-light">

        <!-- Header -->
		<?php require_once("../HTMLSnippets/header.php"); ?>

        <!-- Nav Bar -->
        <?php require_once("../HTMLSnippets/navbar.php") ?>
	
		<!-- Summary - Current Month -->
		<?php require_once("Snippets/SummaryCurrentMonth.php"); ?>

		<!-- Expenses - Current Month Amounts -->
		<?php require_once("Snippets/ExpensesCurrentMonthAmounts.php"); ?>
		
		<!-- Expenses - All Time Percentages -->
		<?php require_once("Snippets/ExpensesAllTimePercentages.php"); ?>
		
	</div>

</body>

</html>