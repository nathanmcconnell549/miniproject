<?php

    //Connect to DB
    require_once("../DB/dbConn.php");

    //Validates a Text Box - NOT empty + ONLY letters
    function validateLettersOnly($value, $textBox) {

        //Trim White Space
        $value = str_replace(' ', '', $value);

        //NOT Empty Check
        if(empty($value)) {
            $error = "$textBox is empty";
            array_push($_SESSION['errors'], $error);

        //Letters ONLY check
        } else {
            if (!ctype_alpha($value)) {
                $value = "$textBox contains numbers";
                array_push($_SESSION['errors'], $value);
            }    
        }
    }

    //Validate Email
    function validateEmail($value) {

        //Ensure Email is Valid
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
        {
            $value = "Email Address is invalid";
            array_push($_SESSION['errors'], $value);
        } 

        //Ensure Email doesn't already exist
        validateExistingUser($value);
    }

    //Validates Password - NOT Empty + DO Match
    function validatePassword($firstPassword, $secondPassword) {

        //NULL Check - First Password
        if(empty($firstPassword)) {
            $value = "Password not entered";

        //NULL Check - Second Password
        } else if(empty($secondPassword)) {
            $value = "Confirm Password not entered";

        //Passwords Match Check
        } else {
            if ($firstPassword != $secondPassword)
                $value = "Passwords don't match";
        }

        //Update Error List
        if(isset($value))
            array_push($_SESSION['errors'], $value);
    }

    //Check User Doesn't Already Exist
    function validateExistingUser($value) {

        //Check DB for Username
        $usernameExists = existingUsernameCheck($value);

        //Update Error List
        if($usernameExists === true) {
            $value = "Username '$value' already exists";
            array_push($_SESSION['errors'], $value);
        } 
    }

    //Check Username And Password Match
    function validateUsernameAndPasswordMatch($email, $password) {

        //Check User Exists
        $usernameExists = existingUsernameCheck($email);

        //Update Error List / Continue
        if($usernameExists === false) {
            $value = "Username doesn't exist";
            array_push($_SESSION['errors'], $value);
        } else {

            //Get Password for Username
            $dbPassword = getPasswordForUsername($email);
            $_SESSION['password'] = $dbPassword;

            //Update Error List / Continue
            if($password != $dbPassword) {
                $value = "Password incorrect";
                array_push($_SESSION['errors'], $value);
            }    
        }
    }

    //Validate Date
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    function validateCurrency($value)
    {
        //Round Value to 2 Decimal places
        $value = round($value, 2);

        if(is_numeric($value)) {

        } else {
            $error = "Invalid Amount";
            array_push($_SESSION['errors'], $error);
        }
    }

    function validateEditTransaction($date, $description, $amount) {

        //Validate Date
        if(!validateDate($date)){
            $error = "Invalid Date";
            array_push($_SESSION['errors'], $error);
        }

        //Validate Description
        validateLettersOnly($description, "Description");

        //Validate Amount
        validateCurrency($amount);
    }

?>