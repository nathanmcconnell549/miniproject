<?php
		
	//Start Session
	session_start();
	require_once("../DB/dbConn.php");

	//Display Regular Income Table
	function displayRegularIncomeTable() {

		//SQL
		$sql = "SELECT * FROM Transactions WHERE UserID = '".$_SESSION['UserID']."' and Type = 'RegularIncome' and isDeleted = '0';";
			
		//Run Query
		$result = getTableData($sql);

		//Display
		while($row = mysqli_fetch_assoc($result)) { 

			echo "<tr>";
				echo "<td>"; echo $row['Description']; echo"</td>";
				echo "<td>"; echo $row['Amount']; echo"</td>";
				echo "<td><a href='EditRegularIncome.php?id=".$row['TransID']."'>Edit</a></td>";
			echo "</tr>";
		} 
	}

	//Display Other Income Table
	function displayOtherIncomeTable() {

		//SQL
		$sql = "SELECT * FROM Transactions WHERE UserID = '".$_SESSION['UserID']."' and Type = 'OtherIncome' and isDeleted = '0';";
			
		//Run Query
		$result = getTableData($sql);

		//Display
		while($row = mysqli_fetch_assoc($result)) { 

			echo "<tr>";
			echo "<td>"; echo $row['Date']; echo"</td>";
				echo "<td>"; echo $row['Description']; echo"</td>";
				echo "<td>"; echo $row['Amount']; echo"</td>";
				echo "<td><a href='EditOtherIncome.php?id=".$row['TransID']."'>Edit</a></td>";
				echo "<td><a href='DeleteIncome.php?id=".$row['TransID']."'>Delete</a></td>";
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
        <?php require_once("../HTMLSnippets/header.php") ?>

        <!-- Nav Bar -->
        <?php require_once("../HTMLSnippets/navbar.php") ?>
	
		<div class="row">
		
			<div class="col-1"></div>
			
			<div class="col-3 bg-white">
			
                <div class="card mt-5">
                    
                    <div class="card-head bg-light">
                    
                        <h4 class="mt-2">Add Other Income</h4>
                    
                    </div>
                    
                    <div class="card-body">
                    
                        <form action="AddIncome.php" class="text-center">
                            
                            <div class="form-group">
                            
                                <input type="submit" name="searchButton" value="Add New">
                                
                            </div>
                        
                        </form>
                    
                    </div>
                
                </div>
				
			</div>
			
			<div class="col-7 bg-white">
			
				<div class="card mt-5">
				
					<div class="card-head bg-light">
					
						<h4 class="mt-2">Regular Income (Salary)</h4>
					
					</div>
					
					<div class="card-body">
					
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Description</th>
									<th scope="col">Amount (£)</th>
									<th scope="col">Edit</th>
								</tr>
						    </thead>
							<tbody>
								<?php
									displayRegularIncomeTable();
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-1"></div>
			
		</div>

		<div class="row">
		
			<div class="col-1"></div>
			
			<div class="col-3 bg-white"></div>
			
			<div class="col-7 bg-white">
			
				<div class="card mt-5">
				
					<div class="card-head bg-light">
					
						<h4 class="mt-2">Other Income</h4>
					
					</div>
					
					<div class="card-body">
					
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Date</th>
									<th scope="col">Description</th>
									<th scope="col">Amount (£)</th>
									<th scope="col">Edit</th>
									<th scope="col">Delete</th>
								</tr>
						    </thead>
							<tbody>
								<?php
									displayOtherIncomeTable();
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-1"></div>
			
		</div>
		
	</div>

</body>

</html>