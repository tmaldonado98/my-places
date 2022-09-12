<?php
include("connect.php");
session_start();

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];

$marker=$_GET['editid'];
    
$populateFields = mysqli_query($con, "SELECT * FROM places WHERE marker='$marker'");
$row = mysqli_fetch_assoc($populateFields);
    $rcountry=$row['country'];
    $rcity=$row['city'];
    $rlandmark=$row['landmark'];

if (isset($_POST['update'])) {
$update = mysqli_query($con, "UPDATE places SET marker = '$marker', country='$country', city='$city', landmark='$landmark' WHERE marker='$marker'"); 

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Row</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <tr>
        <form method="post">
            <label for="country"><p>Country</p></label>
            <input class="text" id="country" placeholder="Country" type="text" name="country" value="<?php echo $rcountry;?>"></input>
            <label for="city"><p>City</p></label>
            <input class="text" id="city" placeholder="City" type="text" name="city" value="<?php echo $rcity;?>"></input>
            <label for="landmark"><p>Landmark</p></label>
            <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark" value="<?php echo $rlandmark;?>"></input>
            <input class="btn1" type="submit" name="update" value="Update"></input>
        </form>
    </tr>    
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
<script src="./script.js" type="text/javascript"></script>
</html>

