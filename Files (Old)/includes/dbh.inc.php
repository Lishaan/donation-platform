<?php  

$server = "localhost";
$username = "lishan";
$password = "067699";
$database = "donation-platform";

// Connect to database
$connection = mysqli_connect($server, $username, $password, $database);

if (!$connection) {
	echo "No database connection";
} else {
	echo "SJKS";
}