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
    <link rel="stylesheet" href="./modals.css">
</head>
<body>
<section id="want">
<!-- <div id="column-w-1"> -->

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
    
echo '<h1>Where I Want To Go</h1>';
echo '<div id=container-table-btns>';
    echo '<table id=table>';
    echo '<tr>
    <th> </th>
    <th>Country</th>
    <th>City</th>
    <th>Landmark</th>
    <th>Select All <input id=sel-all type=checkbox></th>
    </tr>';
    echo '';

//     $name = 'modal' . $marker;
//     $value = $marker;
//     $markup = "<td class=container-see-more><a href=# name=see-more id=see-more value=$marker>See More</a>
//     <dialog name=modal id=modal value=$marker>
//         <div class=close>&#10006;</div>
//         <a href='editRow.php' value=$marker id='edit-row' name=edit>Edit</a>
//         <a href='delete-modal.php' value=$marker id=remove-row name=delete>Remove Place</a>
//         <p id=dummy-text>This is $marker</p>
//     </dialog>

// </td>";

//     // class Modal {
//     //     public $name;
//     //     public $value;
//     //     public $markup;

//     //     function __construct($markup){
//     //         $this->markup = $markup;    
//     //     }

//     //     function get_markup(){
//     //         return $this->markup;
//     //     }
    // }

    if($data = mysqli_query($con, "SELECT * FROM places ORDER BY marker ASC")){
        while ($row = $data->fetch_assoc()) {
            $marker = $row['marker'];

            echo "<tr name=row class=data-row  value=$marker>";
            // echo "<td>" . $row['marker'] . "</td>";
            echo "<td><ul><li></li></ul></td>";
            echo "<td>" . ucwords($row['country']) . "</td>";
            echo "<td>" . ucwords($row['city']) . "</td>";
            echo "<td>" . ucwords($row['landmark']) . "</td>";
///THIS EVENT REMOVES DESIRED ROW FROM BOTH PAGE AND DB TABLE UPON REMOVE BTN PRESS
            echo "<td><form id='cbox-form' action='delete.php' method='post'>
            <input class=checkbox type=checkbox name='checkbox[]' value='$marker'>
            </td>";

            echo "";

            // $modal = new Modal($markup);
            // echo $modal->get_markup();

            echo "<td class=container-see-more><a href=# name=see-more class=see-more value=$marker>See More</a>
                <dialog name=modal class=modal value=$marker>
                    <div class=close>&#10006;</div>
                    <a href='editRow.php' value=$marker id='edit-row' name=edit>Edit</a>
                    <a href='delete-modal.php' value=$marker id=remove-row name=delete>Remove Place</a>
                    <p id=dummy-text>This is $marker</p>
                </dialog>
            
            </td>";

            
            echo '</tr>';
        }
echo '</table> <br>';
} else {
echo 'No results to display.';
};

$select = ("SELECT * FROM places");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<p><b>Total Number Of Places: " . $rowcount . "</b></p>";

?>

<div id="container-print">
    <input id="print" type="button" value="Print Page">
    <br>
    <input id="pdf" type="button" value="Save PDF">
</div>


</div id=container-table-btns>


    <div id="btn-msg">
    <div id="btn">
                <input type="submit" id="del-sel" name="delete_sel" value="Delete Selection">
            </form>

            <?php 
                if (isset($_SESSION['status'])){
                    echo "<h4 id=fdback>" . $_SESSION['status'] ."</h4>";
                    unset ($_SESSION['status']);
                };
            ?>
        </div>

        
        <div id="container-add-place">
            <div id="head-text">
                <h3 id="med-head">Add A New Place</h3>
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
                    <div id="container-btn1">
                <input id="btn1" type="submit" name="submit" value="Add New Place"></input>
                </form>
            </div>
            </div>
        </div>





    <!-- </div>         -->
    




                

    </form>
</div>




<!-- <div id="column-w-2"> -->
    <h3>Average Weather</h3>
    <h3>Did You Know?</h3>
    <h3>Some Facts About This Place</h3>

    <?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);


$data = [
   "q" => $country, $city, $landmark,  
   "tbm" => "isch",
   "num" => "5",
];

curl_setopt($ch, CURLOPT_URL,   'https://customsearch.googleapis.com/customsearch/v1?key=AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA&cx=22bdf86666de74d21%20&filter=1&q=?randomsearch&searchType=image');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    // "apikey: 1a3be160-2e79-11ed-85ee-2bfcdd59e9c8",  
));

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

var_dump($json);



/*
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://duckduckgo-duckduckgo-zero-click-info.p.rapidapi.com/?q=?$country,$city,$landmark&format=json&skip_disambig=1&no_redirect=1&no_html=1&callback=process_duckduckgo",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: duckduckgo-duckduckgo-zero-click-info.p.rapidapi.com",
		"X-RapidAPI-Key: 39895f3948mshc954d1855356b54p15bcacjsn1c6cdc2ab2cd"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

$json = json_decode($response);

var_dump($json);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
*/

$image_results = $json['image_results'];

    echo '<div id=container-figure>'; 
foreach($image_results as $result) {
    $source = $result['sourceUrl'];
 

    echo '<figure class=figure-img>
    <img class=img src="'.$source.'">
    </figure>';
    '</div>';
}

// curl \;
//   'https://customsearch.googleapis.com/customsearch/v1?cx=22bdf86666de74d21%20&filter=1&q=enterqueryhere&searchType=image&key=[AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA ]' \;
//   --header 'Accept: application/json' \;
//   --compressed;

?>

<!-- </div> -->

</section>

<button id="already-btn">+</button>
<section id="already-been">
    <div id="column-ab-1">
    <!-- ajax see more section-->
    
    </div >
    </section>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script defer type="text/javascript" src="script.js"></script>
<!-- jQuery Modal -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->

<?php
mysqli_close($con);
?>
</body>
</html>
