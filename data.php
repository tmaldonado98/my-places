<?php
include "connect.php";

if($data = mysqli_query($con, "SELECT * FROM places ORDER BY position")){
    while ($row = $data->fetch_assoc()) {
        $marker = $row['marker'];
        $position = $row['position'];

        // $row['country'];
?>
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker >
        <div class=drag-container>
                <!-- // echo "<td>" . $row['marker'] . "</td> -->
            <td>
                <svg viewBox="0 0 100 80" width="20" height="20" fill="white">
                    <rect width="100" height="15" rx="8"></rect>
                    <rect y="30" width="100" height="15" rx="8"></rect>
                    <rect y="60" width="100" height="15" rx="8"></rect>
                </svg>
            </td>

            <form id='cbox-form' action='delete.php' method='post'>
            <td class=check-td>
                <input class=checkbox type=checkbox name='checkbox[]' value='$marker'>
            </td>

            <td><?php ucwords($row['country']) ?> </td>
            <td><?php ucwords($row['city']) ?> </td>
            <td><?php ucwords($row['landmark']) ?></td>
<!--     ///THIS EVENT REMOVES DESIRED ROW FROM BOTH PAGE AND DB TABLE UPON REMOVE BTN PRESS -->

            <td class=container-see-more><a href=# name=see-more class=see-more value=$marker>See More</a>
                <dialog name=modal class=modal value=$marker>
                    <div class=close>&#10006;</div>
                    <a href='editRow.php?editid=$marker' value=$marker id='edit-row' name=edit>Edit</a>
                    <a href='delete-modal.php' value=$marker id=remove-row name=delete>Remove Place</a>
                    <p id=modal-title><b><?php ucwords($row['landmark'])." ". ucwords($row['city'])." ". ucwords($row['country'])." "?></b></p>
                </dialog>

            </td>

        </div>   

    </tr>
<?php
    }
}
?>
    </table> <br>
</div>

</div id=container-table-btns>


    <div id="btn-msg">
    <div id="btn">
                <input type="submit" id="del-sel" name="delete_sel" value="Delete Selection">
            </form>
    </div>
    </div>