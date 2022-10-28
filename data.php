<?php
include "connect.php";

// echo "YO YO YO";

$result = array();
if($data = mysqli_query($con, "SELECT * FROM places ORDER BY position")){
    while ($row = $data->fetch_assoc()) {
        $result[] = $row;
        $marker = $row['marker'];
        $position = $row['position'];

/*echo"        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value= '$marker'  >
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
                        <a href='editRow.php?editid= $marker ' value= $marker  id='edit-row' name=edit>Edit</a>
                        <a href='delete-modal.php' value= $marker  id=remove-row name=delete>Remove Place</a>
                        <p id=modal-title><b>" . ucwords($row['landmark'])." ". ucwords($row['city'])." ". ucwords($row['country'])." " . "</b></p>
                    </dialog>

                </td>

            </div>   

        </tr> 
        ";*/

    }
}
echo json_encode($result);
?>

