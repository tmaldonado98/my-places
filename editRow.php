<?php
include("connect.php");

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];

$markerid=$_GET['editid'];
// $marker = $row['marker'];    

$populateFields = mysqli_query($con, "SELECT * FROM places WHERE marker='$markerid'");
$singleRow = mysqli_fetch_assoc($populateFields);
    $rcountry=$row['country'];
    $rcity=$row['city'];
    $rlandmark=$row['landmark'];

// if (isset($_POST['update'])) 
if (isset($_GET['populate'])) {
    if ($_GET['populate']) {
        # code...
    }
    populateFields();
}

function populateFields(){
include "connect.php";
$update = mysqli_query($con, "UPDATE places SET marker = '$markerid', country='$country', city='$city', landmark='$landmark' WHERE marker='$markerid'"); 

    if ($update) {
        $_SESSION['status'] = "<p>Your information has been updated</p>";
        header('location: places.php');
    } else {
        $_SESSION['status'] = "<p>Error updating your information</p>";
        die(mysqli_error($con));
        header('location: places.php');
    }
};     
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Row</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <php
$data =    '<tr>
        <form method="post">
            <label for="country"><p>Country</p></label>
            <input class="text" id="country" placeholder="Country" type="text" name="country" value="<?php echo $rcountry;?>"></input>
            <label for="city"><p>City</p></label>
            <input class="text" id="city" placeholder="City" type="text" name="city" value="<?php echo $rcity;?>"></input>
            <label for="landmark"><p>Landmark</p></label>
            <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark" value="<?php echo $rlandmark;?>"></input>
            <input class="btn1" type="submit" name="update" value="Update"></input>
        </form>
    </tr>    ';
    // echo json_encode($data);
    ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
<script src="./script.js" type="text/javascript"></script>
</html>
 -->
