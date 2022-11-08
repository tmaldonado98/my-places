<?php
include "connect.php";
// session_start();

if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $id) {
        $sql = "DELETE FROM places WHERE marker = $id";
        mysqli_query($con, $sql);
    }

};


/*
    if (isset($_POST['action'])) {
    if ($_POST['action'] == 'delete') {
        deleteFunct();
    }
};

function deleteFunct(){
    global $con;
    
    $marker = $_POST['action'];
    // echo $marker;
    // echo 'test';
    $extract_marker = implode(', ' , $marker);

    $query = "DELETE FROM places WHERE marker = $extract_marker";

   $result = mysqli_query($con, $query);

   $truncate = mysqli_query($con, "ALTER TABLE places AUTO_INCREMENT = 1");

//    $noRows = ("DELETE * FROM places");
//    $count2 = mysqli_query($con, $noRows);
//    $reset = ("TRUNCATE TABLE places");
//    $truncate2 = mysqli_query($con, $reset);
//     header('location: places.php');

if ($result) {
    $_SESSION['status'] = "<p>Your information has been updated</p>";
    $truncate;
    header('location: places.php');
} else {
    $_SESSION['status'] = "<p>Error updating your information</p>";
    die(mysqli_error($con));
    header('location: places.php');
} 
};

*/

?>