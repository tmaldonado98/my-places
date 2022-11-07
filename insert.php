<?php
include "connect.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'insert') {
        insert();
    }
}


function insert(){
    global $con;

        $country = $_POST['country'];
        $city = $_POST['city'];
        $landmark = $_POST['landmark'];
        $position = 0;
    
        $query = "INSERT INTO places(country, city, landmark, position) VALUES ('$country', '$city', '$landmark', '$position')";
        
        $insert = mysqli_query($con, $query);


        if ($insert) {
                $_SESSION['status'] = "<p>Your information has been updated</p>";
                // header('location: places.php');
            };
    };
    

// $display = "SELECT * FROM places";

// $result = mysqli_query($con, $display);

// echo $result;


?>