<html>
        
    <div class="row bg-white mt-2 mb-2">
    
        <div class="col-12 mt-5"><h1 class="text-dark">Summary - Current Month</h1></div>
		
	</div>
	
	<div class="row bg-white mt-2 mb-2">
    
        <div class="col-3 mt-5 mb-5"></div>
        
        <div class="col-3 mt-5 mb-5">
        
			<!-- Totals Card -->
            <div class="card">
            
                <div class="card-head bg-light">
                
					<!-- Title -->
                    <h4 class="mt-2">Totals</h4>
                
                </div>
                
                <div class="card-body">
                
					<!-- Totals Card - Table -->
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">Income</th>
                            <td>&pound;<?php echo $_SESSION['montlyTotalIncome']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Bills</th>
                            <td>&pound;<?php echo $_SESSION['montlyTotalBills']; ?> </td>
                        </tr>
                        <tr>
                            <th scope="col">Expenses</th>
                            <td>&pound;<?php echo $_SESSION['montlyTotalExpenses']; ?></td>
                        </tr>
                            <th scope="col">Remaining</th>
                            <td>&pound;<?php echo $_SESSION['currentAvailable']; ?></td>
                        </tr>
                    </table>
                </div>
            
            </div>
        
        </div>
        
        <div class="col-3 mt-5 mb-5">
        
			<!-- Pie Chart Card -->
            <div class="card">
                
                <div class="card-body">
                
                    <canvas id="summaryCurrentMonthChart">
                
                    <script>
                    var ctx = document.getElementById('summaryCurrentMonthChart');
                    var summaryCurrentMonthChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Outgoings (Bills + Expenses)', 'Remaining'],
                            datasets: [{
                                label: 'Expense Summary',
                                data: [<?php echo $_SESSION['montlyTotalOutgoings'].", ".$_SESSION['currentAvailable'] ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            
                        }
                    });
                    </script>
                
                    </canvas>
                    
                </div>
            
            </div>
            
        </div>	
        
    </div>

</html>