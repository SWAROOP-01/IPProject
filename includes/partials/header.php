<?php
    require "../../config/config.php";


    if(isset($_SESSION['username'])){
        $loggedin_user = $_SESSION['username'] ;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAW4PAW</title>
    <link rel="stylesheet" href="../../Public/Stylesheets/main.css">
</head>
<body>

  HEADER INCLUDED <p></p>