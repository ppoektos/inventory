<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	#$link = mysql_connect(':/var/run/mysqld/mysqld.sock', '', '');
	#if (!$link) { die ('Connection error: ' . mysql_error()); }

	#$db_selected = mysql_select_db('', $link);
	#if (!$db_selected) { die ('Database error: ' . mysql_error()); }
	
	$servername = "";
    $username = "";
    $password = "";
    $dbname = "";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>
