<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	$servername = "mysql";
    $username = "inv";
    $password = "inv";
    $dbname = "inv";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>
