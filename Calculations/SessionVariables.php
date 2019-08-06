<?php 

    //Required Files
    require_once("../DB/dbConn.php");
    require_once("SetDates.php");

    //Monthly Summary Totals
    $_SESSION['monthlyTotalRegularIncome'] = getMontlyTotal("RegularIncome");
    $_SESSION['monthlyTotalOtherIncome'] = getMontlyTotal("OtherIncome");
    $_SESSION['montlyTotalIncome'] = $_SESSION['monthlyTotalRegularIncome'] + $_SESSION['monthlyTotalOtherIncome'];
    $_SESSION['montlyTotalIncome'] = number_format((float)$_SESSION['montlyTotalIncome'], 2, '.', '');
    $_SESSION['montlyTotalBills'] = getMontlyTotal("Bills");
    $_SESSION['montlyTotalExpenses'] = getMontlyTotal("Expenses");
    $_SESSION['montlyTotalOutgoings'] = $_SESSION['montlyTotalBills'] + $_SESSION['montlyTotalExpenses'];

    //Current Available
    $_SESSION['currentAvailable'] = $_SESSION['montlyTotalIncome'] - $_SESSION['montlyTotalOutgoings'];
    $_SESSION['currentAvailable'] = number_format((float)$_SESSION['currentAvailable'], 2, '.', ''); 
    
    //Monthly Expense Totals
    $_SESSION['monthlyTotalGroceries'] = getMontlyTotal("Groceries");
    $_SESSION['monthlyTotalTravel'] = getMontlyTotal("Travel");
    $_SESSION['monthlyTotalEatingOut'] = getMontlyTotal("Eating Out");
    $_SESSION['monthlyTotalEntertainment'] = getMontlyTotal("Entertainment");
    $_SESSION['monthlyTotalHome'] = getMontlyTotal("Home");
    $_SESSION['monthlyTotalOther'] = getMontlyTotal("Other");

    //All Time Expense Totals
    $_SESSION['allTimeTotalGroceries'] = getAllTimeTotal("Groceries");
    $_SESSION['allTimeTotalTravel'] = getAllTimeTotal("Travel");
    $_SESSION['allTimeTotalEatingOut'] = getAllTimeTotal("Eating Out");
    $_SESSION['allTimeTotalEntertainment'] = getAllTimeTotal("Entertainment");
    $_SESSION['allTimeTotalHome'] = getAllTimeTotal("Home");
    $_SESSION['allTimeTotalOther'] = getAllTimeTotal("Other");
    $_SESSION['allTimeTotalExpenses'] = $_SESSION['allTimeTotalGroceries'] + $_SESSION['allTimeTotalTravel'] + $_SESSION['allTimeTotalEatingOut'] + $_SESSION['allTimeTotalEntertainment'] + $_SESSION['allTimeTotalHome'] + $_SESSION['allTimeTotalOther'];     
   
   //All Time Expense Percentages
   if($_SESSION['allTimeTotalExpenses'] != 0) {

        $_SESSION['allTimePercentageGroceries'] = round(($_SESSION['allTimeTotalGroceries'] / $_SESSION['allTimeTotalExpenses']) * 100, 0); 
        $_SESSION['allTimePercentageTravel'] = round(($_SESSION['allTimeTotalTravel'] / $_SESSION['allTimeTotalExpenses']) * 100, 0); 
        $_SESSION['allTimePercentageEatingOut'] = round(($_SESSION['allTimeTotalEatingOut'] / $_SESSION['allTimeTotalExpenses']) * 100, 0);
        $_SESSION['allTimePercentageEntertainment'] = round(($_SESSION['allTimeTotalEntertainment'] / $_SESSION['allTimeTotalExpenses']) * 100, 0);
        $_SESSION['allTimePercentageHome'] = round(($_SESSION['allTimeTotalHome'] / $_SESSION['allTimeTotalExpenses']) * 100, 0);
        $_SESSION['allTimePercentageOther'] = round(($_SESSION['allTimeTotalOther'] / $_SESSION['allTimeTotalExpenses']) * 100, 0);

   } else {

        $_SESSION['allTimePercentageGroceries'] = 0; 
        $_SESSION['allTimePercentageTravel'] = 0;
        $_SESSION['allTimePercentageEatingOut'] = 0;
        $_SESSION['allTimePercentageEntertainment'] = 0;
        $_SESSION['allTimePercentageHome'] = 0;
        $_SESSION['allTimePercentageOther'] = 0;

   } 
       
?>