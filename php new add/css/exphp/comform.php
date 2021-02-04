
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from dashboard-------------------*/
    $feedback_id = $_POST['feedbid'];
    /*--------------- feedback--------------------*/
    $feedback = "SELECT * FROM feedback WHERE feedback_id = '$feedback_id'";
    $feedback_result = mysqli_query($conn, $feedback) or die (mysqli_error($conn));
    $feedback_result_row = $feedback_result-> fetch_assoc();

    $feedback_item_id = $feedback_result_row['feedback_item_id'];
    $feed_user_id = $feedback_result_row['feedback_user_id'];
    $feed_user_state = $feedback_result_row['feedback_user_state'];

    /*------item details for feed-----*/
    $item = "SELECT * FROM item WHERE item_id = '$feedback_item_id'";
    $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
    $item_row = $item_result-> fetch_assoc();

     /*----user details------*/
     if($feed_user_state == "student"){
        $user = "SELECT * FROM student WHERE student_id='$feed_user_id'";
        $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
        $user_row = $user_result-> fetch_assoc();
      }else{
        $user = "SELECT * FROM staff WHERE staff_id='$feed_user_id' AND job_position='$feed_user_state'";
        $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
        $user_row = $user_result-> fetch_assoc();
      }
   echo' 
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><div id="comform_tital">Are You Sure? Remove This</div></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Item : '.$item_row['barcode'].'</p>
          <p>Titel : '.$feedback_result_row['feedback_tital'].'</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
          <a href="exphp/feedremove.php?feedreid='.$feedback_id .'"><button type="button" class="btn btn-primary">ok</button></a>
        </div>
      </div>';

    ?>