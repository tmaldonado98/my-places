<?php
include "connect.php";
?>
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
        
echo "            
<tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker>
    <div class=drag-container>
        <td id='handle'>
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
            <div id=modal-title><b> <span id=m-landmark>" . ucwords($row['landmark'])."</span><span id=mlc>,</span> <span id=m-city>". ucwords($row['city'])."</span><span id=mcc>,</span> <span id=m-country>". ucwords($row['country'])."</span></b></div>
            

            <div id=container-search-engine>
            ".
                // <div class=lds-ring><div></div><div></div><div></div><div></div></div>
                "
                <div class=search-engine>
                                          
                </div>
            </div>
            
            <section id=section-edit>
                <div id=container-ed-del>
                    <input type='button' name='edit' class=modal-edit value='Edit Place'></input>
                    <input type='button' dataId=$marker class=modal-delete name=modal_delete value='Remove Place'>
                </div>
                    <div class='edit-field' name=edit_field>
                        <span class=inputs>
                            <label for='country'><p>Country</p></label>
                            <input class='ed-text' id='ed-country' placeholder='Country' type='text' autocomplete='off' name='editCountry' value=$rcountry>
                            <label for='city'><p>City</p></label>
                            <input class='ed-text' id='ed-city' placeholder='City' type='text' autocomplete='off' name='editCity' value=$rcity>
                            <label for='landmark'><p>Landmark</p></label>
                            <input class='ed-text' id='ed-landmark' placeholder='Landmark/Place' type='text' autocomplete='off' name='editLandmark' value=$rlandmark>
                        </span>
                            <br>
                        <div class=update-btn>
                           <input class=editBtn dataId=$marker type='button' value='Update'>
                        </div>
                    </div>
            </section>

            <div id=section-modal-map>
                <div id=modal-map-container>
                    <div id=modal-map>
                
                    </div>
                </div>
            </div>
        
            <div id=container-section-facts>
            <h3>Some Facts About Your Place</h3>
                <div id=container-facts>
                    <div id=facts1>
                        <p id=fCountry><b>Country:</b> <span></span></p>
                        <p id=countryPop><b>Country Total Population:</b> <span></span> </p>
                        <p id=fCapital><b>Capital City:</b> <span></span></p>

                        <p id=fCity><b>Your City:</b> <span></span> </p>
                        <p id=cityPop><b>City Population:</b> <span></span> </p>
                        <p id=fRel><b>National Religious Demographics (as of 2020):</b> <br><span></span> </p>".

                        // <p id=fEthnic><b>National Ethnic Demographics:</b> <span></span> </p> 
                        "


                    </div>

                    <div id=facts2>
                        <p id=fLangs><b>Main Language(s) Spoken:</b> <span></span> </p>
                        <p id=govt><b>Type Of Government:</b> <span></span> </p>
                        <p id=fGdp><b>National Average GDP per Capita (in USD):</b> <span></span> </p>
                        <p id=fMigrants><b>% of Country Inhabitants International Migrants:</b> <br><span></span> </p>
                        <p id=fCurr><b>National Currency:</b> <span></span> </p>
                        <p id=as-of>This information is current as of 2021</p>
                        <p>Sources: World Bank, UN Data Bank</p>
                    </div>
                </div>
            </div>
"
            // <div id=container-news>
            //     <div id=news>
            //         'news' cse section here
            //     </div>
            // </div>

            // <div id=container-people-of>
            //     <div id=people-of>
            //         'people of' cse section here
                    
            //     </div>
            // </div>
."


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
            //curly brackets to end the while loop and the if statement

/*
$markerid=$_GET['editid'];
// $marker = $row['marker'];    

$populateFields = mysqli_query($con, "SELECT * FROM places_table WHERE marker='$markerid'");
$singleRow = mysqli_fetch_assoc($populateFields);
    $rcountry=$row['country'];
    $rcity=$row['city'];
    $rlandmark=$row['landmark'];

// if (isset($_POST['update'])) 
if (isset($_GET['populate'])) {
    populateFields();
}

function populateFields(){
include "connect.php";
$update = mysqli_query($con, "UPDATE places_table SET marker = '$markerid', country='$country', city='$city', landmark='$landmark' WHERE marker='$markerid'"); 

                        

*/

// <a href='editRow.php?editid= $marker value= $marker  id='edit-row' name=edit></a>





// $select = ("SELECT * FROM places_table");
// $count = mysqli_query($con, $select);
// $rowcount = mysqli_num_rows($count);
// echo "<div id=total-places><p><b>Total Number Of Places: " . $rowcount . "</b></p></div>

//     <div id='btn-msg'>
//     <div id='btn'>
//                 <input type='button' class='del-sel' name='delete_sel' value='Delete Selection'>
        
//             </form>
//     </div>    

// </div id=container-table-btns>
               
           
?>

