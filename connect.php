<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    
    session_start();

    $servername = 'localhost';
    $username = 'root';
    $psw = 'california14';
    $dbname = 'places_app';
    
    $con = new mysqli($servername, $username, $psw, $dbname);
    
    if ($con->connect_error) {
        echo 'Connection failed: '. mysqli_connect_error();
    } else {
     //   echo 'You are connected.';
    }

    // $con->close();
?>