
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from remove comform box-------------------*/
    $feedback_id = $_GET['feedreid'];
    /*------delete row in feedback -------*/
    $delete_feed = "DELETE FROM feedback WHERE feedback_id='$feedback_id'";
    $delete_feed_result = mysqli_query($conn, $delete_feed) or die (mysqli_error($conn));

    /*------load feedback.php-------*/
     header('Location: ../feedback.php');


?>