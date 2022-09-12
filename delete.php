<?php
include "connect.php";
session_start();

if (isset($_POST['delete_sel'])) {
    $marker = $_POST['checkbox'];
    $extract_marker = implode(',' , $marker);
    // echo $extract_marker;
   $query = "DELETE FROM places WHERE marker IN ($extract_marker)";

   $result = mysqli_query($con, $query);

   $truncate = mysqli_query($con, "ALTER TABLE places AUTO_INCREMENT = 1");
};
// /*
if ($result) {
    $_SESSION['status'] = "<p>Your information has been updated</p>";
    header('location: places.php');
} else {
    $_SESSION['status'] = "<p>Error updating your information</p>";
    die(mysqli_error($con));
    header('location: places.php');
} //*/
?>

<!-- if (isset($_GET['deleteid'])) {
    $marker=$_GET['deleteid']; -->
