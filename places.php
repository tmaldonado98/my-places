<?php     
include "connect.php";
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['update'])) {
    foreach ($_POST['positions'] as $position) {
        $marker = $position[0];
        $newPosition = $position[1];

        $con->query(query: "UPDATE places SET position='$newPosition' WHERE marker='$marker'");
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
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.min.css">
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

    if($data = mysqli_query($con, "SELECT * FROM places ORDER BY position")){
        while ($row = $data->fetch_assoc()) {
            $marker = $row['marker'];
            $position = $row['position'];
            echo "<tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker >";
            // echo "<div class=drag-container>";
                // echo "<td>" . $row['marker'] . "</td>";
                echo '<td>
                    <svg viewBox="0 0 100 80" width="20" height="20" fill="white">
                        <rect width="100" height="15" rx="8"></rect>
                        <rect y="30" width="100" height="15" rx="8"></rect>
                        <rect y="60" width="100" height="15" rx="8"></rect>
                    </svg>
                </td>';

                echo "<form id='cbox-form' action='delete.php' method='post'>";
                echo "<td class=check-td>
                        <input class=checkbox type=checkbox name='checkbox[]' value='$marker'>
                    </td>";

                echo "<td>" . ucwords($row['country']) . "</td>";
                echo "<td>" . ucwords($row['city']) . "</td>";
                echo "<td>" . ucwords($row['landmark']) . "</td>";
///THIS EVENT REMOVES DESIRED ROW FROM BOTH PAGE AND DB TABLE UPON REMOVE BTN PRESS
                


                echo "";

                echo "<td class=container-see-more><a href=# name=see-more class=see-more value=$marker>See More</a>
                        <dialog name=modal class=modal value=$marker>
                            <div class=close>&#10006;</div>
                            <a href='editRow.php?editid=$marker' value=$marker id='edit-row' name=edit>Edit</a>
                            <a href='delete-modal.php' value=$marker id=remove-row name=delete>Remove Place</a>
                            <p id=dummy-text><b>".ucwords($row['landmark'])." ". ucwords($row['city'])." ". ucwords($row['country'])." ". "</b></p>

                        </dialog>

                        </td>";

            // echo "</div>";    

                echo '</tr>';

            // include 'insert.php';
            // if (insert()) {
            //     echo $row;
            // }

        }
echo '</table> <br>';
} else {
echo 'No results to display.';
};
    echo '</div>';

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
<!--  -->
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
                        <input class="text" id="country" placeholder="Country" type="text" name="country" "></input>
                        <!-- onkeyup="countrySuggestion(this.value) -->
                        <p><span id='country-sug'></span></p>
                    </div>
                    <div class="container-input">
                        <label for="city"><p>City</p></label>
                        <input class="text" id="city" placeholder="City" type="text" name="city" ></input>
                        <!-- onkeyup="citySuggestion(this.value)" -->
                        <p><span id='city-sug'></span></p>
                    </div>
                    <div class="container-input">
                        <label for="landmark"><p>Landmark</p></label>
                        <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark"></input>
                    </div>
                    <div id="container-btn1">
                        <input id="btn1" type="button" onclick="submitData('insert')" name="submit" value="Add New Place"></input>
                        <!-- type="submit" -->
                    </div>
                </form>
                    
            </div>
        </div>
    <!-- </div>         -->             

    <!-- </form> -->
</div>




<!-- <div id="column-w-2"> -->
    <h3>Average Weather</h3>
    <h3>Did You Know?</h3>
    <h3>Some Facts About This Place</h3>




<!-- </div> -->

</section>

<button id="already-btn">+</button>
<section id="already-been">
    <div id="column-ab-1">
    <!-- ajax see more section-->
    
    </div >
    </section>

<script defer type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI plugin -->
<script defer src="./jquery-ui-1.13.2.custom/jquery-ui.js"></script>

<!-- <script defer src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script> -->
<script defer type="text/javascript" src="script.js"></script>
<script defer type="text/javascript" src="rows.js"></script>



<!-- jQuery Modal -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->

<?php
mysqli_close($con);
?>
</body>
</html>
