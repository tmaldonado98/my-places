<?php
include "connect.php";
session_start();

// if (isset($_POST['delete_sel'])) {
if (isset($_POST['checkbox'])) {

    $marker = $_POST['checkbox'];
    echo $marker;
    echo 'test';
    $extract_marker = implode(', ' , $marker);
    // echo $extract_marker;
   $query = "DELETE FROM places WHERE marker IN ($extract_marker)";

   $result = mysqli_query($con, $query);

   $truncate = mysqli_query($con, "ALTER TABLE places AUTO_INCREMENT = 1");

//    $noRows = ("DELETE * FROM places");
//    $count2 = mysqli_query($con, $noRows);
//    $reset = ("TRUNCATE TABLE places");
//    $truncate2 = mysqli_query($con, $reset);
//     header('location: places.php');

};

if ($result) {
    $_SESSION['status'] = "<p>Your information has been updated</p>";
    header('location: places.php');
} else {
    $_SESSION['status'] = "<p>Error updating your information</p>";
    die(mysqli_error($con));
    header('location: places.php');
} 

?>

<!-- if (isset($_GET['deleteid'])) {
    $marker=$_GET['deleteid']; -->
