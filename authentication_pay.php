<?php
// echo "<h1>Hello Sarthak Gupta</h1>";
include('connection.php');
$ownername = $_POST['user'];
$cardnumber = $_POST['card'];
$month = $_POST['mm'];
$year = $_POST['yy'];
$cvv = $_POST['cvv'];

//to prevent from mysqli injection  
$ownername = stripcslashes($ownername);
$cardnumber = stripcslashes($cardnumber);
$month = stripcslashes($month);
$year = stripcslashes($year);
$cvv = stripcslashes($cvv);
$ownername = mysqli_real_escape_string($con, $ownername);
$cardnumber = mysqli_real_escape_string($con, $cardnumber);
$month = mysqli_real_escape_string($con, $month);
$year = mysqli_real_escape_string($con, $year);
$cvv = mysqli_real_escape_string($con, $cvv);

$sql = "select * from payment where ownername = '$ownername' and cardnumber = '$cardnumber'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo "<h1 style='background-color:black;
    color:white;margin-top:0%;padding:20% 0;
    font-size:50px;'><center> Payment successful ! Have a nice day</center></h1>";
} else {
    echo "<h1 style='background-color:black;
    color:white;margin-top:0%;padding:20% 0;
    font-size:50px;'><center> Payment failed. Invalid ownername or cardnumber.</h1>";
}
?>