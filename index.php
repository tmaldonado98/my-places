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
    <table id=table cellspacing="15">
        <tr>
            <th>#</th>
            <th>Country</th>
            <th>City</th>
            <th>Landmark</th>
            <th> </th>
            <th>Select All <input id=sel-all type=checkbox></th>
        </tr>
<br>
    
            <tr class=data-row>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href='editRow.php?editid=$marker' class='edit-row' name=edit>Edit</a></td>";
                 <td><a href='delete.php?deleteid=".$row['marker']."' class=remove-row type=submit name=delete>Remove Place</a></td>";
                <td><form id='cbox-form' action='delete.php' method='post'>
                <input class=checkbox type=checkbox name='checkbox[]' value='$marker'>
                </td>
            
            </tr>
        
    </table>



    <input type="submit" id="del-sel" name="delete_sel" value="Delete Places">
</form>

<input id="print" type="button" value="Print Page">

<form method="post">
    <input type="submit" value="Save My List">
</form>

<!-- undo btn -->

<tr>
    <h4 id="med-head">Add Your Place Here:</h4>
    <form >
        <label for="country"><p>Country</p></label>
        <input class="text" id="country" placeholder="Country" type="text" name="country"></input>
        <label for="city"><p>City</p></label>
        <input class="text" id="city" placeholder="City" type="text" name="city"></input>
        <label for="landmark"><p>Landmark</p></label>
        <input class="text" id="landmark" placeholder="Landmark" type="text" name="landmark"></input>
        <input class="btn1" type="button" name="submit" value="Add New Place"></input>
    </form>
</tr>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="./index.js"></script>
<script type="text/javascript" src="./script.js"></script>


<?php
mysqli_close($con);
?>
</body>
</html>