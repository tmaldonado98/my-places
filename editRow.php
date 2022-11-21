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
    
    
    $populateFields = mysqli_query($con, "SELECT * FROM places_table WHERE marker='$marker'");
    // $singleRow = mysqli_fetch_assoc($populateFields);

        if ($populateFields) {
            while ($row = mysqli_fetch_array($populateFields)) {
                
                /*
        echo    "<span class=inputs>
                    <label for='country'><p>Country</p></label>
                    <input class='text' id='ed-country' placeholder='Country' type='text' name='editCountry' value='$country'></input>
                    <label for='city'><p>City</p></label>
                    <input class='text' id='ed-city' placeholder='City' type='text' name='editCity' value='$city'></input>
                    <label for='landmark'><p>Landmark</p></label>
                    <input class='text' id='ed-landmark' placeholder='Landmark' type='text' name='editLandmark' value='$landmark'></input>
                </span>";
            }
        }

}*/


// if (isset($_GET['populate'])) 
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        // updatePhp();
        $edcountry = $_POST['editCountry'];
        $edcity = $_POST['editCity'];
        $edlandmark = $_POST['editLandmark'];
        // $position = 0;
        // $marker = $_POST['marker'];    
        // position= '$position'
        
        $query = "UPDATE places_table SET country= '$edcountry', city= '$edcity', landmark= '$edlandmark' ";
        
        $update = mysqli_query($con, $query);
        
        
        if ($update) {
                $_SESSION['status'] = "<p>Your information has been updated</p>";
                // header('location: places.php');
            };
    }
}

// function updatePhp(){
    // global $con;

// }

/*
function populateFields(){
include "connect.php";
$update = mysqli_query($con, "UPDATE places_table SET marker = '$markerid', country='$country', city='$city', landmark='$landmark' WHERE marker='$markerid'"); 

    if ($update) {
        $_SESSION['status'] = "<p>Your information has been updated</p>";
        header('location: places.php');
    } else {
        $_SESSION['status'] = "<p>Error updating your information</p>";
        die(mysqli_error($con));
        header('location: places.php');
    }
};*/     
?>