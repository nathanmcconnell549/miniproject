<?php

    //File with all DB related requests

    //Connect to DB
    function establishConnection()  {
                       
        $servername = "scm.ulster.ac.uk";
        $username = "B00684214";
        $password = "EWVUDn5w";
        $database = "B00684214";

        return mysqli_connect($servername, $username, $password, $database);
    }

    //Check Username exists in DB
    function existingUsernameCheck($value) {

        $conn = establishConnection();
        $usernameExists = false;

        $sql = "SELECT * FROM Members WHERE Username = '$value'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
            $usernameExists = true;

        $conn->close();

        return $usernameExists;
    }

    //Add User
    function addUser($firstName, $lastName, $email, $monthlySalary, $password) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        //Set SQL Query
        $sql = "INSERT INTO Members (Firstname, Surname, Username, MonthlySalary, Password) 
        VALUES ('$firstName', '$lastName', '$email', '$monthlySalary', '$password')";

        if ($conn->query($sql) === TRUE) {

            //Assign User ID
            $_SESSION['UserID'] = getUserID($email);
            
            //Open Home
            header("Location: ../Home/Home.php");

            $date = date("Y-m-01", time());

            //Add Salary
            addTransaction($_SESSION['UserID'], $date, "Salary", "RegularIncome", $monthlySalary);

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    //Get User ID
    function getUserID($email) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM Members WHERE Username = '$email'"; 
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $id = $row['UserID'];

        $conn->close();

        return $id;
    }

    //Get Password for Username
    function getPasswordForUsername($email) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM Members WHERE Username = '$email'"; 
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $dbPassword = $row['Password'];

        $conn->close();

        return $dbPassword;
    }

    //Delete Transaction
    function deleteTransaction($id) {

        $transDeleted = false;
        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "UPDATE Transactions SET isDeleted = '1' 
        WHERE TransID = '$id';";

        if ($conn->query($sql) === TRUE) {
            $transDeleted = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        return $transDeleted;
    }

    //Get Row from DB
    function getRow($id) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM Transactions WHERE TransID = '$id'"; 
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row;

        $conn->close();
    }

    //Edit Transaction in DB
    function editTransaction($date, $description, $type, $amount, $id) {

        $transEdited = false;
        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        if($date == "")
            $date = date("y-m-d", time());

        $sql = "UPDATE Transactions
        SET Date = '$date', Description = '$description', Type = '$type', Amount = '$amount' 
        WHERE TransID = '$id'";

        if ($conn->query($sql) === TRUE) {
            $transEdited = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        return $transEdited;
    }

    //Get Data from DB for Table
    function getTableData($sql) {

        //Connect to DB
        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $result = mysqli_query($conn, $sql);
        
        return $result;
    }

    //Add Transaction to DB
    function addTransaction($userID, $date, $description, $type, $amount) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        //Set SQL Query
        $sql = "INSERT INTO Transactions (UserID, Date, Description, Type, Amount, isDeleted) 
        VALUES ('$userID', '$date', '$description', '$type', '$amount', '0')";

        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    //Get Monthly Total for any transaction
    function getMontlyTotal($type) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $currentMonth = date("m", time());
        $currentYear = date("Y", time());
        $userID = $_SESSION['UserID'];

        //Build SQL Statement
        if($type == "Expenses") {

            $sql = "SELECT SUM(Amount) AS totalAmount FROM Transactions
            WHERE MONTH(Date) = '$currentMonth' and YEAR(Date) = '$currentYear'
            AND UserID = '$userID' And isDeleted = '0'
            AND Type != 'RegularIncome' AND Type != 'OtherIncome' AND Type != 'Bills'"; 

        } else {

            $sql = "SELECT SUM(Amount) AS totalAmount FROM Transactions
            WHERE MONTH(Date) = '$currentMonth' and YEAR(Date) = '$currentYear'
            AND UserID = '$userID' And isDeleted = '0'
            AND Type = '$type'";

        }

        //Get Result
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        //Get Total
        $sum = $row['totalAmount'];

        if(empty($sum))
            $sum = 0;

        return $sum;

        $conn->close();
    }

    //Set Regular Income Date
    function setRegularIncomeDate() {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $firstDayOfMonth = date("Y-m-01", time());
        $userID = $_SESSION['UserID'];

        //Build SQL Statement
        $sql = "UPDATE Transactions SET Date = '$firstDayOfMonth'
        WHERE UserID = '$userID' AND Type = 'RegularIncome';";

        //Get Result
        mysqli_query($conn, $sql);

        $conn->close();
    }

    //Set Bill Dates
    function setBillsDate() {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $firstDayOfMonth = date("Y-m-01", time());
        $userID = $_SESSION['UserID'];

        //Build SQL Statement
        $sql = "UPDATE Transactions SET Date = '$firstDayOfMonth'
        WHERE UserID = '$userID' AND isDeleted = '0' AND Type = 'Bills';";

        //Get Result
        mysqli_query($conn, $sql);

        $conn->close();
    }

    //Gets Amount For All Time
    function getAllTimeTotal($type)
    {
        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Set User ID
        $userID = $_SESSION['UserID'];

        //Build SQL Statement
        if ($type == "Expenses") {
            $sql = "SELECT SUM(Amount) AS totalAmount FROM Transactions
            WHERE UserID = '$userID' And isDeleted = '0'
            AND Type != 'RegularIncome' AND Type != 'OtherIncome' AND Type != 'Bills'";
        } else {
            $sql = "SELECT SUM(Amount) AS totalAmount FROM Transactions
            WHERE UserID = '$userID' And isDeleted = '0'
            AND Type = '$type'";
        }

        //Get Result
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        //Get Total
        $sum = $row['totalAmount'];

        if (empty($sum)) {
            $sum = 0;
        }

        return $sum;

        $conn->close();
    }

    //Reset Password
    function updatePassword($email, $password) {

        $conn = establishConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Build SQL
        $sql = "UPDATE Members Set Password = '$password' WHERE Username = '$email'";

        $result = mysqli_query($conn, $sql);
    }

?>