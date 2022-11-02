<?php
include "connect.php";


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
        if($data = mysqli_query($con, "SELECT * FROM places ORDER BY position")){
            while ($row = $data->fetch_assoc()) {
                $result[] = $row;
                $marker = $row['marker'];
                $position = $row['position'];
                // echo $marker;
echo "            
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value= '$marker'  >
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

                <td>" . ucwords($row['country']) . "</td>
                <td>" . ucwords($row['city']) . "</td>
                <td>" . ucwords($row['landmark']) . "</td>

                <td class=container-see-more><a href=# name=see-more class=see-more value=$marker>See More</a>
                    <dialog name=modal class=modal value=$marker>
                        <div class=close>&#10006;</div>
                        <p id=modal-title><b>" . ucwords($row['landmark'])." ". ucwords($row['city'])." ". ucwords($row['country'])." " . "</b></p>
                        <a href='delete-modal.php' value= $marker  id=remove-row name=delete>Remove Place</a>
                        <input type=button name=populate value='Edit Place' id=edit-btn> 
                            <div id='edit-field' editid= $marker>"
                                /*<form method='post' action='editRow.php' editid= $marker>
                                    <label for='country'><p>Country</p></label>
                                    <input class='text' id='country' placeholder='Country' type='text' name='country' value='". $rcountry ."'></input>
                                    <label for='city'><p>City</p></label>
                                    <input class='text' id='city' placeholder='City' type='text' name='city' value='". $rcity ."'></input>
                                    <label for='landmark'><p>Landmark</p></label>
                                    <input class='text' id='landmark' placeholder='Landmark' type='text' name='landmark' value='". $rlandmark ."'></input>
                                    <br>
                                    <input class='btn1' type='button' name='update' value='Update'></input>
                                </form>*/."
                            </div>
                    </dialog>
                </td>
            </div>   
        </tr>

";
    }
}
//curly brackets to end the while loop and the if statement

/*
$markerid=$_GET['editid'];
// $marker = $row['marker'];    

$populateFields = mysqli_query($con, "SELECT * FROM places WHERE marker='$markerid'");
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
$update = mysqli_query($con, "UPDATE places SET marker = '$markerid', country='$country', city='$city', landmark='$landmark' WHERE marker='$markerid'"); 

                        

*/

// <a href='editRow.php?editid= $marker value= $marker  id='edit-row' name=edit></a>
 

echo "    </table> <br>
</div>" 
?>

<?php
$select = ("SELECT * FROM places");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<p><b>Total Number Of Places: " . $rowcount . "</b></p>";

?>

</div id=container-table-btns>


    <div id="btn-msg">
    <div id="btn">
                <!-- <input type="submit" id="del-sel" name="delete_sel" value="Delete Selection"> -->
        </form>
    </div>    
        

<?php 
                if (isset($_SESSION['status'])){
                    echo "<h4 id=fdback>" . $_SESSION['status'] ."</h4>";
                    unset ($_SESSION['status']);
                };
                
            ?>
    </div>

<!-- echo json_encode($result); -->