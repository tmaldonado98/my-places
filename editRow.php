<?php
include("connect.php");
        
// $position = 0;

if (isset($_POST['action'])) {
        $markerid = $_POST['id'];
        $edcountry = $_POST['edCountry'];
        $edcity = $_POST['edCity'];
        $edlandmark = $_POST['edLandmark'];
        if ($_POST['action'] == 'edit') {
            // updatePhp();
            // echo 'update posted';

        
            $query = "UPDATE places_table SET country = $edcountry, city = $edcity, landmark = $edlandmark WHERE marker = $markerid";         
            // $query = "UPDATE `places_table` SET `marker`='$markerid',`country`='$edcountry',`city`='$edcity',`landmark`='$edlandmark',`position`='$position' WHERE marker = '$markerid'";
            $exec = mysqli_query($con, $query);

        } 
    }    
/*
function updatePhp(){
    global $con;


    // if(mysqli_affected_rows($con) >0 ){
    //     echo 'success';
    // }

    // if ($exec) {
    //     // echo 'Success';
    //     header('location: places.php');
    // } else {
    //     echo 'keep trying';
    // }

}*/
 mysqli_close($con);
?>