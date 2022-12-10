<?php     
include "connect.php";

if (isset($_POST['update'])) {
    foreach ($_POST['positions'] as $position) {
        $marker = $position[0];
        $newPosition = $position[1];
        $query = "UPDATE places_table SET position='$newPosition' WHERE marker='$marker'";
        mysqli_query($con, $query);
    }
    exit('success');
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>My List Of Places</title>
    <link rel="icon" href="./icons8-globe-32.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./modal-magnific-popup/magnific-popup.css">
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <script src="https://kit.fontawesome.com/602ec316c2.js" crossorigin="anonymous"></script>
    <link href='https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.css' rel='stylesheet'/>
</head>
<body>

<nav>
    <div id="contact">
        <div class='nav-btns'><a href="https://github.com/tmaldonado98" target="_blank" rel="noopener noreferrer" title="My Github Profile">Github</a></div>
        <div class='nav-btns'><a href="mailto:tmaldonadotrs@gmail.com" target="_blank" rel="noopener noreferrer" title="Send me an email!">Email</a></div>
    </div>
</nav>
<div id=container-print>
    <i class="fa-solid fa-print fa-xl print" title="Print Page"></i>
    <p class="print" title="Print Page">Print</p>
    <i class="fa-solid fa-question" title="To save as a PDF file click on 'Print' button, press on 'Destination' menu list, and select 'Save to PDF'."></i>
</div>

<section id="want">  

<h1>Where I Want To Go</h1>
<div id=container-table-btns>
    <div id=container-table>
        <table id=table>
            <tr id=heading-row>
                <th> </th>
                <th>Select All <input id=sel-all type=checkbox></th>
                <th>Country</th>
                <th>City</th>
                <th>Landmark</th>
                <th> </th>
            </tr>


<?php

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];


        $result = array();
        if($data = mysqli_query($con, "SELECT * FROM places_table ORDER BY position")){
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
                $marker = $row['marker'];
                $position = $row['position'];
                $rcountry=ucwords($row['country']);
                $rcity=ucwords($row['city']);
                $rlandmark=ucwords($row['landmark']);
                $edit = 'edit';

echo "            
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker>
            <div class=drag-container>
                <td>
                    <svg viewBox='0 0 100 80' width='20' height='20' fill='black'>
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
                                              
                    </div>
                    <hr>

                    <div id=container-ed-del>
                        <input type='button' name='edit' class=modal-edit value='Edit Place'></input>
                        <input type=button dataId=$marker class=modal-delete name=modal_delete value='Remove Place'>
                    </div>
                        <div class='edit-field' name=edit_field>
                            <span class=inputs>
                                <label for='country'><p>Country</p></label>
                                <input class='ed-text' id='ed-country' placeholder='Country' type='text' name='editCountry' value=$rcountry>
                                <label for='city'><p>City</p></label>
                                <input class='ed-text' id='ed-city' placeholder='City' type='text' name='editCity' value=$rcity>
                                <label for='landmark'><p>Landmark</p></label>
                                <input class='ed-text' id='ed-landmark' placeholder='Landmark' type='text' name='editLandmark' value=$rlandmark>
                            </span>
                                <br>
                            <div class=update-btn>
                               <input class=editBtn dataId=$marker type='button' value='Update'>
                            </div>
                        </div>

                    <div id=section-modal-map>
                        <div id=modal-map-container>
                            <div id=modal-map>
                        
                            </div>
                        </div>
                    </div>
                                            
                </div>
            </div class=drag-container>   
        </tr>

                        ";
                    }
                }
        if (isset($_POST['id'])) {
            $markerid = $_POST['id'];
            $edcountry = $_POST['edCountry'];
            $edcity = $_POST['edCity'];
            $edlandmark = $_POST['edLandmark'];

            $exec = mysqli_query($con, "UPDATE `places_table` SET `country` = '".$edcountry."', `city` = '".$edcity."', `landmark` = '".$edlandmark."' WHERE `marker` = '".$markerid."'");
    
            // if (!$con->query($exec)) {
            //     echo "query failed: (" . $con->errno . ") " . $con->error;
            //     }
        } 

echo "    </table>
</div>"; 

$select = ("SELECT * FROM places_table");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<p id=total-places ><b>Total Number Of Places: " . $rowcount . "</b></p>";

?>
       
            <div id="btn-msg">
            <div id="btn">
                        <input type="button" class="del-sel" name="delete_sel" value="Delete Selection">
                        
                    </form>
            </div>    
        
</div id=container-table-btns>

    </div>

        
        <div id="container-add-place">
            <div id="head-text">
                <h3 id="med-head">Add A New Place</h3>
                <div id="add-place">
                    <div class="container-input">
                        <label for="country"><p>Country</p></label>
                        <input autofocus class="text" id="country" placeholder="Country" type="text" name="country"></input>
                    </div>
                    <div class="container-input">
                        <label for="city"><p>City</p></label>
                        <input class="text" id="city" placeholder="City" type="text" name="city" ></input>
                    </div>
                    <div class="container-input">
                        <label for="landmark"><p>Landmark</p></label>
                        <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark"></input>
                    </div>
                </div>

                    <div id="container-insertBtn">
                        <input id="insertBtn" type="button" value="Add New Place"></input>
                    </div>
            </div>
        </div>

</div>
</section>

<section id="map-section">
    <div id="map-container">
        <div id="map">

        </div>
    </div>
</section>

<footer>
    <p>
        Tomas Maldonado 2022
    </p>

</footer>

<?php
mysqli_close($con);
?>

<script defer type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- jQuery UI plugin -->
<script defer src="./jquery-ui-1.13.2.custom/jquery-ui.js"></script>

<script defer type="text/javascript" src="script.js"></script>
<!-- <script defer type="text/javascript" src="rows.js"></script> -->
<script src='https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.js'></script>
<!-- <script defer src="modals-script.js"></script> -->
<!-- <script defer src="https://www.googleapis.com/customsearch/v1?key=AIzaSyAHakO0K7mac852qUCsJxSq0sozCCvy-xA&cx=22bdf86666de74d21&q=search query"></script> -->

<!-- 
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
                    </div> -->
</body>
</html>