<?php
include "connect.php";

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];
    
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
            // $data->fetch_assoc()
                $result[] = $row;
                $marker = $row['marker'];
                $position = $row['position'];
                $rcountry=ucwords($row['country']);
                $rcity=ucwords($row['city']);
                $rlandmark=ucwords($row['landmark']);
echo "            
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value= '$marker'  >
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
                
                <td>" . ucwords($row['country']) . "</td>
                <td>" . ucwords($row['city']) . "</td>
                <td>" . ucwords($row['landmark']) . "</td>
                
                <td class=container-see-more><a href=#$marker name=see-more class='see-more open-popup-link popup-with-zoom-anim'  value=$marker>See More</a>
                </td>

                <div id=$marker name=modal class='modal zoom-anim-dialog mfp-hide' value=$marker>
                    <p id=modal-title><b> <span id=m-landmark>" . ucwords($row['landmark'])."</span> <span id=m-city>". ucwords($row['city'])."</span> <span id=m-country>". ucwords($row['country'])."</span></b></p>
                    <hr>

                    <div class=search-engine>
                                              
                    </div>
                    <hr>

                    <div id=container-ed-del>
                        <input type='button' name='edit' class=modal-edit value='Edit Place'></input>
                        <input type=button class=modal-delete name=modal_delete value='Remove Place'>
                    </div>
                        <div class='edit-field' name=edit_field value=$marker>
                            <span class=inputs>
                                <label for='country'><p>Country</p></label>
                                <input class='ed-text' id='ed-country' placeholder='Country' type='text' name='editCountry' value='$rcountry '>
                                <label for='city'><p>City</p></label>
                                <input class='ed-text' id='ed-city' placeholder='City' type='text' name='editCity' value='$rcity'>
                                <label for='landmark'><p>Landmark</p></label>
                                <input class='ed-text' id='ed-landmark' placeholder='Landmark' type='text' name='editLandmark' value='$rlandmark'>
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
            echo "   </div>
                </table> <br>
            </div>" ;
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





$select = ("SELECT * FROM places_table");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<div id=total-places><p><b>Total Number Of Places: " . $rowcount . "</b></p></div>

    <div id='btn-msg'>
    <div id='btn'>
                <input type='button' class='del-sel' name='delete_sel' value='Delete Selection'>
        
            </form>
    </div>    

</div id=container-table-btns>
";                
           
?>

<!-- echo json_encode($result); -->