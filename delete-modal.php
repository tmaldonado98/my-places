<?php
include "connect.php";
// session_start();

    $data = mysqli_query($con, "SELECT * FROM places_table");
    $row = $data->fetch_assoc();


    $marker = $_POST['rowData'];
    // $row['marker'];
    

    // $query = "DELETE FROM places WHERE marker=$marker";

    // $result = mysqli_query($con, $query);

    if (isset($marker)) {
        $sql = "DELETE FROM places_table WHERE marker = $marker";
        $result = mysqli_query($con, $sql);
    }

    // $truncate = mysqli_query($con, "ALTER TABLE places_table AUTO_INCREMENT = 1");



    if ($result) {
        $_SESSION['status'] = "<p>Your information has been updated</p>";
        header('location: places.php');
    } else {
        $_SESSION['status'] = "<p>Error updating your information</p>";
        die(mysqli_error($con));
        header('location: places.php');
    }


?>