<?php

    //Start Session
    session_start();
    
?>

<html>

<head>

    <title>Registration Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body class="bg-dark">    

    <div class="container-fluid bg-dark">

        <!-- Header -->
        <div class="row bg-light">

            <div class="col-6">

                <h1 class="text-left text-black font-italic ml-1">miniproject</h1>

            </div>

        </div>

        <div class="row">

            <div class="col-4 mb-5"></div>

            <div class="col-4 mb-5">

                <div class="card bg-white align-center mt-5">

                    <div class="card-head bg-light">

                        <h4 class="text-center mt-2 mb-2">Registration</h4>

                    </div>

                    <div class="card-body bg-white">
                
                        <form action="ValidateRegistration.php" method="POST">

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
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Please enter First Name">
                            </div>

                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="Please enter Last Name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email (Username)</label>
                                <input type="text" class="form-control" name="email" placeholder="email@email.com">
                            </div>

                            <div class="form-group">
                                <label for="monthlySalary">Monthly Salary After Tax (£)</label>
                                <input type="number" step="any" class="form-control" name="monthlySalary" placeholder="1000.00">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmPassword">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="mt-2">Submit</button>
                            </div>
                            
                        </form>

                    </div>

                    <div class="card-footer" id="webConsole">

                        <script>
                        
                            var webConsole = function (msg) 
                            {
                                var console = $('#webConsole');
                                var newMessage = $('<p>').text(msg);
                                console.append(newMessage);
                            }

                        </script>

                        <script>        

                            var first_name = $('#firstName');
                            webConsole("#first_name is: " + first_name.val());

                        </script>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>