<?php
include "connect.php";
// session_start();

    $data = mysqli_query($con, "SELECT * FROM places");
    $row = $data->fetch_assoc();


    $marker = $row['marker'];
    // $_POST['rowValue'];

    // $query = "DELETE FROM places WHERE marker=$marker";

    // $result = mysqli_query($con, $query);

    if (isset($marker)) {
        $sql = "DELETE FROM places WHERE marker = $marker";
        $result = mysqli_query($con, $sql);
    }

    // $truncate = mysqli_query($con, "ALTER TABLE places AUTO_INCREMENT = 1");



    if ($result) {
        $_SESSION['status'] = "<p>Your information has been updated</p>";
        header('location: places.php');
    } else {
        $_SESSION['status'] = "<p>Error updating your information</p>";
        die(mysqli_error($con));
        header('location: places.php');
    }


?>