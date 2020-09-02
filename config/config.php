<?php
ob_start(); // Turns on Output buffering
$timezone = date_default_timezone_set("Asia/Kolkata");
// Start Session
	session_start();


	// CONNECTING TO THE DATABASE
    $con = mysqli_connect("localhost" ,"root","","pawfectDB");
    if(mysqli_connect_errno()){
        echo "Failed To Connect !  " . mysqli_connect_errno();
    }
?>