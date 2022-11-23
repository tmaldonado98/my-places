<?php     
include "connect.php";
// include "scraperapi.php";

if (isset($_POST['update'])) {
    foreach ($_POST['positions'] as $position) {
        $marker = $position[0];
        $newPosition = $position[1];

        $con->query(query: "UPDATE places_table SET position='$newPosition' WHERE marker='$marker'");
    }
    exit('success');
}
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
    <link rel="stylesheet" href="./tableA.css">
    <link rel="stylesheet" href="./modal-magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="dialog-styling.css">
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <script async src='https://cse.google.com/cse.js?cx=22bdf86666de74d21'></script>
</head>
<body>
<section id="want">
<!-- <div id="column-w-1"> -->

<?php

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];


////SEPARATED INSERT QUERY FROM FETCH ROW DATA QUERY TO PREVENT PHP PAGE FROM INSERTING ROW INTO DB TABLE AFTER PAGE REFRESH
/*if (isset($_POST['submit'])) {
    $insert = mysqli_query($con, "INSERT INTO places(country, city, landmark) VALUES ('$country', '$city', '$landmark')"); 
};*/    
    
echo '<h1>Where I Want To Go</h1>';
echo '<div id=container-table-btns>';
echo    '<div id=container-table>';
    echo '<table id=table>';
        echo '<tr id=heading-row>
            <th> </th>
            <th>Select All <input id=sel-all type=checkbox></th>
            <th>Country</th>
            <th>City</th>
            <th>Landmark</th>
            
        </tr>';
        echo '';
        $result = array();
        if($data = mysqli_query($con, "SELECT * FROM places_table ORDER BY position")){
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
                $marker = $row['marker'];
                $position = $row['position'];
                $rcountry=ucwords($row['country']);
                $rcity=ucwords($row['city']);
                $rlandmark=ucwords($row['landmark']);
echo "            
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker>
            <div class=drag-container>
                <td>
                    <svg viewBox='0 0 100 80' width='20' height='20' fill='white'>
                        <rect width='100' height='15' rx='8'></rect>
                        <rect y='30' width='100' height='15' rx='8'></rect>
                        <rect y='60' width='100' height='15' rx='8'></rect>
                    </svg>
                </td>
                
                <form id='cbox-form' action='delete.php' method='post'>
                <td class=check-td>
                    <input class=checkbox type=checkbox name=checkbox[] value=$marker>

                </td>

                <td id=country-text>" . ucwords($row['country']) . "</td>
                <td id=city-text>" . ucwords($row['city']) . "</td>
                <td id=landmark-text>" . ucwords($row['landmark']) . "</td>
                
                
                <td class=container-see-more><a href=#$marker name=see-more class='see-more open-popup-link popup-with-zoom-anim'  value=$marker editid=$marker>See More</a>
                </td>
                
                <div id=$marker name=modal class='modal zoom-anim-dialog mfp-hide' value=$marker>
                    <p id=modal-title><b> <span id=m-landmark>" . ucwords($row['landmark'])."</span> <span id=m-city>". ucwords($row['city'])."</span> <span id=m-country>". ucwords($row['country'])."</span></b></p>
                    <hr>

                    <div id=search-engine>
                        <div class='gcse-searchresults-only'></div> 
                                              
                    </div>
                    <hr>

                    <div id=container-ed-del>
                        <input type='button' name='edit' id=modal-edit value='Edit Place'></input>
                        <input type=button onclick='modalDelete($marker)' id=modal-delete name=modal_delete value='Remove Place'>
                    </div>
                        <div class='edit-field' name=edit_field editid=$marker>
                            <span class=inputs>
                                <label for='country'><p>Country</p></label>
                                <input class='ed-text' id='ed-country' placeholder='Country' type='text' name='editCountry' value='$rcountry '></input>
                                <label for='city'><p>City</p></label>
                                <input class='ed-text' id='ed-city' placeholder='City' type='text' name='editCity' value='$rcity'></input>
                                <label for='landmark'><p>Landmark</p></label>
                                <input class='ed-text' id='ed-landmark' placeholder='Landmark' type='text' name='editLandmark' value='$rlandmark'></input>
                            </span>
                            <br>
                            <div class=update-btn>
                                <input class='btn1' onclick=update('update') type='button' name='update' value='Update'></input>
                            </div>
                        </div>

                    <div id=map>
                        <span>Map will go here </span>
                    </div>

                    <div id=container-facts>
                        <div class=fact-boxes>Capital City: </div>
                        <div class=fact-boxes>Local Currency: </div>
                        <div class=fact-boxes>Average Weather: </div>
                        <div class=fact-boxes>Language(s) Spoken: </div>
                        <div class=fact-boxes>Population Size: </div>
                        <div class=fact-boxes>Ethnic Makeup: </div>
                        <div class=fact-boxes>Religious Demographics: </div>
                        <div class=fact-boxes>Age Demographics: </div>

                        <div class=fact-boxes>Look for a wikipedia/encyclopedia api to insert some historical/cultural facts here</div>
                    </div>
                                            
                </div>
            </div class=drag-container>   
        </tr>
                        
                        ";
                    }
                }

                //curly brackets to end the while loop and the if statement
                // <form method='post' class=edit-form action='editRow.php' editid= $marker>
                
/*
                        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        
        
        $dataSerp = [
            "q" => $country, $city, $landmark,  
           "tbm" => "isch",
           "num" => "5",
        ];
        
        curl_setopt($ch, CURLOPT_URL,   'https://customsearch.googleapis.com/customsearch/v1?key=AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA&cx=22bdf86666de74d21&filter=1&q=france&searchType=image');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            // $dataSerp
            // "apikey: 1a3be160-2e79-11ed-85ee-2bfcdd59e9c8",  
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        $json = json_decode($response, true);
    echo '<pre>';
        $dumped_json = var_dump($json);
echo '</pre>';

// image_results
        $image_results = $dumped_json['link'];

foreach($image_results as $result) {
    $source = $result['string'];

    echo 
    '<figure>
        <img class=img src="'.$source.'">
    </figure>';
};
                        /*


// curl --get https://serpapi.com/search \
//  -d engine='google' \
//  -d q='Coffee' \
//  -d api_key='secret_api_key'




// if (isset($_POST['update'])) 
if (isset($_GET['populate'])) {
    populateFields();
}
$update = mysqli_query($con, "UPDATE places_table SET marker = '$markerid', country='$country', city='$city', landmark='$landmark' WHERE marker='$markerid'"); 
// function populateFields(){}
*/

                        
  // $markerid='editid';
                        // $populateFields = mysqli_query($con, "SELECT * FROM places_table WHERE marker='$marker'");
                        // $singleRow = mysqli_fetch_assoc($populateFields);



// <a href='editRow.php?editid= $marker value= $marker  id='edit-row' name=edit></a>
 

echo "    </table> <br>
</div>"; 


$select = ("SELECT * FROM places_table");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<p id=total-places ><b>Total Number Of Places: " . $rowcount . "</b></p>";

?>

        <div id="container-print">
            <input id="print" type="button" value="Print Page">
            <br>
            <!-- <input id="pdf" type="button" value="Save PDF"> -->
        </div>


        
            <div id="btn-msg">
            <div id="btn">
                        <input type="button" onclick="deleteData('delete')" class="del-sel" name="delete_sel" value="Delete Selection">
                        
                    </form>
            </div>    
        
</div id=container-table-btns>

        

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
                        <!-- <label for="country"><p>Country</p></label> -->
                        <input class="text" id="country" placeholder="Country" type="text" name="country"></input>
                        <!-- onkeyup="countrySuggestion(this.value) -->
                        <p><span id='country-sug'></span></p>
                    </div>
                    <div class="container-input">
                        <!-- <label for="city"><p>City</p></label> -->
                        <input class="text" id="city" placeholder="City" type="text" name="city" ></input>
                        <!-- onkeyup="citySuggestion(this.value)" -->
                        <p><span id='city-sug'></span></p>
                    </div>
                    <div class="container-input">
                        <!-- <label for="landmark"><p>Landmark</p></label> -->
                        <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark"></input>
                    </div>
                </form>

                    <div id="container-btn1">
                        <input id="btn1" type="button" onclick="insertData('insert')" name="submit" value="Add New Place"></input>
                    </div>
                    
            </div>
        </div>
    <!-- </div>         -->             

    <!-- </form> -->
</div>






</section>
<!-- 
<button id="already-btn">+</button>
<section id="already-been">
    <div id="column-ab-1">    
    </div >
    </section> -->
    
<footer>

<script defer type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- jQuery UI plugin -->
<script defer src="./jquery-ui-1.13.2.custom/jquery-ui.js"></script>

<script defer type="text/javascript" src="script.js"></script>
<script defer type="text/javascript" src="rows.js"></script>
<script defer src="modals-script.js"></script>
<!-- <script defer src="https://www.googleapis.com/customsearch/v1?key=AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA&cx=22bdf86666de74d21&q=search query"></script> -->

</footer>

<?php
mysqli_close($con);
?>
</body>
</html>