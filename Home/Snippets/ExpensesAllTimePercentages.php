<html>

    <!-- New Row -->
    <div class="row bg-white mt-2 mb-2">
        
        <!-- Section Title -->
        <div class="col-12 mt-5"><h1 class="text-dark">Expenses - All Time Percentages</h1></div>
    
        <div class="col-3 mt-5 mb-5"></div>
        
        <!-- Table Section -->
        <div class="col-3 mt-5 mb-5">
        
            <!-- Card -->
            <div class="card" height="100">
            
                <!-- Card Head -->
                <div class="card-head bg-light">
                
                    <h4 class="mt-2">Expense Types</h4>
                
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                
                    <!-- Expense Types Table -->
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col">Groceries</th>
                            <td><?php echo $_SESSION['allTimePercentageGroceries'];  ?>%</td>
                        </tr>
                        <tr>
                            <th scope="col">Travel</th>
                            <td><?php echo $_SESSION['allTimePercentageTravel'];  ?>%</td>
                        </tr>
                        <tr>
                            <th scope="col">Eating Out</th>
                            <td><?php echo $_SESSION['allTimePercentageEatingOut'];  ?>%</td>
                        </tr>
                            <th scope="col">Entertainment</th>
                            <td><?php echo $_SESSION['allTimePercentageEntertainment'];  ?>%</td>
                        </tr>
                        </tr>
                            <th scope="col">Home</th>
                            <td><?php echo $_SESSION['allTimePercentageHome'];  ?>%</td>
                        </tr>
                        </tr>
                            <th scope="col">Other</th>
                            <td><?php echo $_SESSION['allTimePercentageOther'];  ?>%</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Chart -->
        <div class="col-3 mt-5 mb-5">
        
            <div class="card" height="100">
                
                <div class="card-body bg-white">
                
                    <canvas id="cT" width="100" height="100">
                    
                        <!-- JavaScript -->
                        <script>
                        var ctx = document.getElementById('cT');
                        var cT = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Groceries', 'Travel', 'Eating Out', 'Entertainment', 'Home', 'Other'],
                                datasets: [{
                                    data: [<?php print($_SESSION['allTimePercentageGroceries'].", ".$_SESSION['allTimePercentageTravel'].", ".$_SESSION['allTimePercentageEatingOut'].", ".$_SESSION['allTimePercentageEntertainment'].", ".$_SESSION['allTimePercentageHome'].", ".$_SESSION['allTimePercentageOther']); ?>], 
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
                            
                        });
                        </script>
                    </canvas>
                </div>
            </div>
        </div>
    </div>

</html>