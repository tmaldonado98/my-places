<?php
include "connect.php";

$result = array();
if($data = mysqli_query($con, "SELECT * FROM places ORDER BY position")){
    while ($row = $data->fetch_assoc()) {
        $result[] = $row;
        $marker = $row['marker'];
        $position = $row['position'];
    }
}
echo json_encode($result);
?>

