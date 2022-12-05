<?php
include("connect.php");
        
if (isset($_POST["action['edit']"])) {
    global $con;
    // if ($_POST['action'] == "edit") {
        $markerid = $_POST['id'];
        $edcountry = $_POST['edCountry'];
        $edcity = $_POST['edCity'];
        $edlandmark = $_POST['edLandmark'];

        // $markerid = '79';
        // $edcountry = 'caca';
        // $edcity = 'caca';
        // $edlandmark = 'caca';

            // updatePhp();
            // echo 'update posted';

        
            // $edquery = "UPDATE `places_table` SET `marker` = '".$markerid."', `country` = '".$edcountry."', `city` = '".$edcity."', `landmark` = '".$edlandmark."', `position` = 0 WHERE `marker` = '".$markerid."'";         
            // $query = "UPDATE `places_table` SET `marker`='$markerid',`country`='$edcountry',`city`='$edcity',`landmark`='$edlandmark',`position`='$position' WHERE marker = '$markerid'";
            $exec = mysqli_query($con, "UPDATE `places_table` SET `marker` = '".$markerid."', `country` = '".$edcountry."', `city` = '".$edcity."', `landmark` = '".$edlandmark."', `position` = 0 WHERE `marker` = '".$markerid."'");

            // $exec = mysqli_query($con, "UPDATE `places_table` SET `country` = 'caca', `city` = 'caca', `landmark` = 'caca' WHERE `marker` = 79");


            if (!$con->query($exec)) {
                echo "query failed: (" . $con->errno . ") " . $con->error;
                }
        }; 
    // };    
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