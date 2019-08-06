<html>

    <div class="row bg-white mt-2 mb-2">
		
        <div class="col-12 mt-5"><h1 class="text-dark">Expenses - Current Month Amounts</h1></div>
    
        <div class="col-3 mt-5 mb-5"></div>
        
        <div class="col-3 mt-5 mb-5">
        
            <div class="card">
            
                <div class="card-head bg-light">
                
                    <h4 class="mt-2">Expense Types</h4>
                
                </div>
                
                <div class="card-body">
                
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">Groceries</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalGroceries']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Travel</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalTravel']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Eating Out</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalEatingOut']; ?></td>
                        </tr>
                            <th scope="col">Entertainment</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalEntertainment']; ?></td>
                        </tr>
                        </tr>
                            <th scope="col">Home</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalHome']; ?></td>
                        </tr>
                        </tr>
                            <th scope="col">Other</th>
                            <td>&pound;<?php echo $_SESSION['monthlyTotalOther']; ?></td>
                        </tr>
                    </table>
                </div>
            
            </div>
        
        </div>
        
        <div class="col-3 mt-5 mb-5">
        
            <div class="card">
                
                <div class="card-body bg-white">
                
                    <canvas id="expensesCurrentMonthAmounts" width="100" height="125">
                    
                        <script>
                        var ctx = document.getElementById('expensesCurrentMonthAmounts');
                        var expensesCurrentMonthAmounts = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Groceries', 'Travel', 'Eating Out', 'Entertainment', 'Home', 'Other'],
                                datasets: [{
                                    
                                    data: [<?php print($_SESSION['monthlyTotalGroceries'].", ".$_SESSION['monthlyTotalTravel'].", ".$_SESSION['monthlyTotalEatingOut'].", ".$_SESSION['monthlyTotalEntertainment'].", ".$_SESSION['monthlyTotalHome'].", ".$_SESSION['monthlyTotalOther']); ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                        </script>
                    
                    
                    </canvas>
                    
                
                </div>
                
            </div>
                
        </div>
        
    </div>


</html>