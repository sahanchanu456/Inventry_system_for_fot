
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from remove comform box-------------------*/
    $item_id = $_GET['itemid'];
    /*------delete row in feedback -------*/
    $delete_item = "DELETE FROM item WHERE item_id='$item_id'";
    $delete_item_result = mysqli_query($conn, $delete_item) or die (mysqli_error($conn));

    /*------load feedback.php-------*/
     header('Location: ../itemcatagory.php');


?>