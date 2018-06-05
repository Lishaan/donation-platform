<?php  
$server = "localhost";
$username = "lishan";
$password = "067699";
$database = "donation-platform";


$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection){
    die("connection object not created: ".mysqli_error($connection));
}

if (mysqli_connect_errno()) { 
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}