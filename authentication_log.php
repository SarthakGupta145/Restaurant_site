<?php
// echo "<h1>Hello Sarthak Gupta</h1>";
include('connection.php');
$username = $_POST['user'];
$password = $_POST['pass'];

//to prevent from mysqli injection  
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$sql = "select * from login where username = '$username' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo "<h1 style='background-color:black;
    color:white;margin-top:0%;padding:20% 0;
    font-size:50px;'><center> Login successful </center></h1>";
} else {
    echo "<h1 style='background-color:black;
    color:white;margin-top:0%;padding:20% 0;
    font-size:50px;'><center> Login failed. Invalid username or password.</h1>";
}
?>