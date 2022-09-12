<?php     
include "connect.php";
session_start();
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Travel Bucket List</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div id="col-left">
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];
////THIS EVENT PREVENTS PHP PAGE FROM INSERTING ROW INTO DB TABLE AFTER PAGE REFRESH
//SEPARATED INSERT QUERY FROM FETCH ROW DATA QUERY.
if (isset($_POST['submit'])) {
    $insert = mysqli_query($con, "INSERT INTO places(country, city, landmark) VALUES ('$country', '$city', '$landmark')"); 
};    
    

echo '<div id=container-table-btns>';
    echo '<table id=table cellspacing="15">';
    echo '<tr>
    <th>#</th>
    <th>Country</th>
    <th>City</th>
    <th>Landmark</th>
    <th> </th>
    <th>Select All <input id=sel-all type=checkbox></th>
    </tr>';
    echo '';
    if($data = mysqli_query($con, "SELECT * FROM places ORDER BY marker ASC")){
        while ($row = $data->fetch_assoc()) {
            $marker = $row['marker'];

            

            echo '<tr class=data-row>';
            echo "<td>" . $row['marker'] . "</td>";
            echo "<td>" . ucwords($row['country']) . "</td>";
            echo "<td>" . ucwords($row['city']) . "</td>";
            echo "<td>" . ucwords($row['landmark']) . "</td>";
///THIS EVENT REMOVES DESIRED ROW FROM BOTH PAGE AND DB TABLE UPON REMOVE BTN PRESS
// DOES NOT YET SELF-ADJUST MARKER COUNTER
            echo "<td><a href='editRow.php?editid=$marker' class='edit-row' name=edit>Edit</a></td>";
            //echo "<td><a href='delete.php?deleteid=".$row['marker']."' class=remove-row type=submit name=delete>Remove Place</a></td>";
            echo "<td><form id='cbox-form' action='delete.php' method='post'>
            <input class=checkbox type=checkbox name='checkbox[]' value='$marker'>
            </td>";
            
            echo '</tr>';
        }
echo '</table>';
} else {
echo 'No results to display.';
};

?> 
    <div id="btn-msg">
        <div id="btn">
                <input type="submit" id="del-sel" name="delete_sel" value="Delete Selection">
            </form>

        </div>

        <div id="msg">
        <?php 
            if (isset($_SESSION['status'])){
                echo "<h4 id=fdback>" . $_SESSION['status'] ."</h4>";
                unset ($_SESSION['status']);
            };
        ?>
        </div>
    </div>
</div id=container-table-btns>


<div id="container-add-place">
    <div id="head-text">
        <h3 id="med-head">Where Would You Go?</h3>
        <form id="add-place" method="post">
            <div class="container-input">
                <label for="country"><p>Country</p></label>
                <input class="text" id="country" placeholder="Country" type="text" name="country"></input>
            </div>
            <div class="container-input">
                <label for="city"><p>City</p></label>
                <input class="text" id="city" placeholder="City" type="text" name="city"></input>
            </div>
            <div class="container-input">
                <label for="landmark"><p>Landmark</p></label>
                <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark"></input>
            </div>
    </div>
        <div id="container-btn1">
            <input id="btn1" type="submit" name="submit" value="Add New Place"></input>
        </div>

</div>        
                

    </form>
    
    <div id="container-print">
        <input id="print" type="button" value="Print Page">
    </div>
</div>

<div id="col-right">

    <img src="" alt="">


</div>

<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$data = [
//    "q" => $country, $city, $landmark,
"q" => 'venice',
   "tbm" => "isch",
   "num" => "2",
];

curl_setopt($ch, CURLOPT_URL, "https://app.zenserp.com/api/v2/search?" . http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "apikey: 1a3be160-2e79-11ed-85ee-2bfcdd59e9c8",  
));

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

// print_r($json);
var_dump($json);

// header('location: places.php');

/*
require 'path/to/google-search-results.php';
require 'path/to/restclient.php';

$query = [
 "engine" => "google",
 "q" => "Venice",
 "google_domain" => "google.com",
 "gl" => "us",
 "hl" => "en",
 "tbm" => "isch",
];

$search = new GoogleSearch('secret_api_key');
$result = $search->get_json($query);
*/

?>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<?php
mysqli_close($con);
?>
</body>
</html>
