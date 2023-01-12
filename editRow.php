<?php
include("connect.php");
        
if (isset($_POST['id'])) {
    // if ($_POST['action'] == "edit") {
        $markerid = $_POST['id'];
        $edcountry = $_POST['edCountry'];
        $edcity = $_POST['edCity'];
        $edlandmark = $_POST['edLandmark'];

        $exec = mysqli_query($con, "UPDATE `places_table` SET `country` = '".$edcountry."', `city` = '".$edcity."', `landmark` = '".$edlandmark."' WHERE `marker` = '".$markerid."'");

        if (!$con->query($exec)) {
            echo "query failed: (" . $con->errno . ") " . $con->error;
        }
    }; 
    // };    

 mysqli_close($con);
?>