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
            
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'update') {
            // updatePhp();
            $markerid=$_GET['marker'];
            $edcountry = $_GET['editCountry'];
            $edcity = $_GET['editCity'];
            $edlandmark = $_GET['editLandmark'];

            $query = "UPDATE places_table SET country = '$edcountry', city = '$edcity', landmark = '$edlandmark', position = '0' WHERE marker= '$markerid'";         
            $update = mysqli_query($con, $query);
            

/*marker= $markerid,
                    $populateFields = mysqli_query($con, "SELECT * FROM places_table WHERE marker='$markerid'");
                    
                    while ($row = mysqli_fetch_array($populateFields)) {
                        $singleRow = mysqli_fetch_assoc($populateFields);
                        
                        $editCountry = $singleRow['country'];
                        $editCity = $singleRow['city'];
                        $editLandmark = $singleRow['landmark'];
                        // $marker = $row['marker'];    
*/
                        /*
echo                "<div class='edit-field2' editid=$marker>
                        <span class=inputs>
                            <label for='country'><p>Country</p></label>
                            <input class='text' id='ed-country' placeholder='Country' type='text' name='editCountry' >" .$editCountry. "</input>
                            <label for='city'><p>City</p></label>
                            <input class='text' id='ed-city' placeholder='City' type='text' name='editCity' >$editCity</input>
                            <label for='landmark'><p>Landmark</p></label>
                            <input class='text' id='ed-landmark' placeholder='Landmark' type='text' name='editLandmark' >$editLandmark</input>
                        </span>
                    </div>";*/
                    // $position = 0;
        // position= '$position'
        
    }

    }
// }

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