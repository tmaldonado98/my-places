<?php
include("connect.php");

// $markerid=$_POST['editid'];
// $rcountry=$row['country'];
// $rcity=$row['city'];
// $rlandmark=$row['landmark'];

/*

if (isset($_POST['update'])) {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $landmark = $_POST['landmark'];
*/           
            
    if (isset($_POST['edit'])) {
        updatePhp();
        // if ($_POST['action'] === 'edit') {
        // } 
    }    

function updatePhp(){
    global $con;

    $markerid = $_POST['marker'];
    $edcountry = $_POST['editCountry'];
    $edcity = $_POST['editCity'];
    $edlandmark = $_POST['editLandmark'];
    $position = 0;

    $query = "UPDATE places_table SET country = '$edcountry', city = '$edcity', landmark = '$edlandmark' WHERE marker = '$markerid'";         
    $exec = mysqli_query($con, $query);

    if ($exec) {
        echo 'Success';
    } else {
        echo 'keep trying';
    }
}

?>