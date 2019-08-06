<?php
		
	//Start Session
	session_start();
	require_once("../DB/dbConn.php");

	//Display Table
	function displayTable() {

		//Search Date
        if (!empty($_SESSION['dateFrom']) && empty($_SESSION['searchType'])) {

			//SQL
            $sql = "SELECT * FROM Transactions 
			WHERE Type != 'Bills' and Type != 'RegularIncome' and Type != 'OtherIncome' and UserID = '".$_SESSION['UserID']."'
			and Date >= '".$_SESSION['dateFrom']."' and Date <= '".$_SESSION['dateTo']."' and isDeleted = '0';";
		
		//Search Type
        } else if(!empty($_SESSION['searchType']) && empty($_SESSION['dateFrom'])) {

			//SQL
			$sql = "SELECT * FROM Transactions 
			WHERE Type != 'Bills' and Type != 'RegularIncome' and Type != 'OtherIncome' and UserID = '".$_SESSION['UserID']."' and Type = '".$_SESSION['searchType']."' and isDeleted = '0';";
		
		//Search Date + Type
		} else if(!empty($_SESSION['searchType']) && !empty($_SESSION['dateFrom'])) {

			//SQL
            $sql = "SELECT * FROM Transactions 
			WHERE Type != 'Bills' and Type != 'RegularIncome' and Type != 'OtherIncome' and UserID = '".$_SESSION['UserID']."' and Date >= '".$_SESSION['dateFrom']."' and Date <= '".$_SESSION['dateTo']."' and Type = '".$_SESSION['searchType']."' and isDeleted = '0';";

		//Default
		} else {

			//SQL
			$sql = "SELECT * FROM Transactions WHERE Type != 'Bills' and Type != 'RegularIncome' and Type != 'OtherIncome' and UserID = '".$_SESSION['UserID']."' and isDeleted = '0';";

		}

		//Unset
		unset($_SESSION['dateFrom']);   
    	unset($_SESSION['dateTo']); 
		unset($_SESSION['searchType']);
			
		//Run Query
		$result = getTableData($sql);

		//Display
		while($row = mysqli_fetch_assoc($result)) { 

			echo "<tr>";
				echo "<td>"; echo $row['Date']; echo"</td>";
				echo "<td>"; echo $row['Description']; echo"</td>";
				echo "<td>"; echo $row['Type']; echo"</td>";
				echo "<td>"; echo $row['Amount']; echo"</td>";
				echo "<td><a href='EditExpense.php?id=".$row['TransID']."'>Edit</a></td>";
				echo "<td><a href='DeleteExpense.php?id=".$row['TransID']."'>Delete</a></td>";
			echo "</tr>";

		} 
	}

?>

<html>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="bg-white text-center">    

    <div class="container-fluid bg-white">

        <!-- Header -->
		<?php require_once("../HTMLSnippets/header.php"); ?>

        <!-- Nav Bar -->
        <?php require_once("../HTMLSnippets/navbar.php") ?>
	
		<div class="row">
		
			<div class="col-1"></div>
			
			<div class="col-3">

				<div class="card mt-5">
					
					<div class="card-head bg-light">
					
						<h4 class="mt-2">Add New Expense</h4>
					
					</div>
					
					<div class="card-body">
					
						<form action="AddExpense.php" class="text-center">
							
							<div class="form-group">
							
								<input type="submit" name="searchButton" value="Add New">
								
							</div>
						
						</form>
					
					</div>
				
				</div>

				<div class="card mt-5">
					
					<div class="card-head bg-light">
					
						<h4 class="mt-2">Refine Search</h4>
					
					</div>
					
					<div class="card-body">
					
						<form action="ValidateRefineSearch.php" method="POST" class="text-left">

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

							<input type="checkbox" name="searchDates"> Search Dates<br>

							<div class="form-group">
						
								<label for="dateFrom">Date From</label><br>
								<input type="date" name="dateFrom" max=<?php echo date('Y-m-d');?> >
								
							</div>
							
							<div class="form-group">
							
								<label for="dateTo">Date To</label><br>
								<input type="date" name="dateTo" value="<?php print(date("Y-m-d")); ?>" max=<?php echo date('Y-m-d');?>>
								
							</div>
							
							<input type="checkbox" name="searchType"> Search Type<br>

							<div class="form-group">
							
								<label for="type">Type</label><br>
								<select name="type">
									<?php foreach($_SESSION['ExpenseTypes'] as $expenseType) echo "<option>$expenseType</option>" ?>
								</select>
							</div>
							
							<div class="form-group">
							
								<input type="submit" name="searchButton">
								<a href="ViewExpenses.php">Reset</a>
								
							</div>
						
						</form>
					
					</div>
				
				</div>
				
			</div>
			
			<div class="col-7">
			
				<div class="card mt-5">
				
					<div class="card-head bg-light">
					
						<h4 class="mt-2">Expenses</h4>
					
					</div>
					
					<div class="card-body">
					
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Description</th>
									<th scope="col">Type</th>
									<th scope="col">Amount (£)</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
						    </thead>
							<tbody>
								<?php
									if(empty($_SESSION['errors'])) 
										displayTable();
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-1"></div>
			
		</div>

		<div class="row mb-5">
		
			<div class="col-1"></div>
			
			<div class="col-3">
			
				
			
		</div>
		
	</div>

</body>

</html>