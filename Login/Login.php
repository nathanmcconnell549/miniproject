<?php

    //Start Session
    session_start();

    //User Authorised 
    $_SESSION['UserAuth'] = false;

?>

<html>

<head>

    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>


<body class="bg-dark">

    <!-- Header -->
    <div class="row bg-light">

        <div class="col-6">

            <h1 class="text-left text-black font-italic ml-3">miniproject</h1>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-4"></div>
        <div class="col-4">

            <div class="card bg-white align-center mt-5">

                <div class="card-head bg-light">

                    <h4 class="text-center mt-2 mb-2">Please Login</h4>

                </div>

                <div class="card-body bg-white">

                    <form action="ValidateLogin.php" method="POST" class="bg-white mt-2 ml-2 mr-2 mb-2">

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

                        <div class="form-group mt-2">
                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>

                        <div class="form-group">
                            <a href="ResetPassword.php">Forgot Password?</a>    
                        </div>

                        <div class="form-group mt-5">
                            <input type="submit" class="form-control bg-light" name="submit" value="Login">
                        </div>

                    </form>

                </div>

                <div class="card-footer text-center">

                    <a class="text-center" href="../Signup/Registration.php">Signup!</a>

                </div>

            </div>

        </div>
    </div>

</body>


</html>