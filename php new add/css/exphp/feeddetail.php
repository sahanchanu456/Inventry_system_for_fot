
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
   echo' <div class="row">
            <div class="col-md-12">
                <div class="card card-user" id="dis_card">
                    <div class="card-header">
                        <h3 id ="item_name">'.$feedback_result_row['feedback_tital'].'</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <p id ="item_dis">'.$feedback_result_row['feedback_feed'].'</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis_hed">Sender Id : </h7>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis_hed">Sender  : </h7>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-2">
                                <div class="form-group">
                                    <h7 id ="item_dis">'.$feedback_result_row['feedback_user_id'].'</h7>
                                </div>
                            </div>
                            <div class="col-md-6 pr-2">
                                <div class="form-group">
                                    <h7 id ="item_dis">'.$user_row['name'].'</h7>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis_hed">Barcode  : </h7>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis_hed">Item Name  : </h7>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis">'.$item_row['barcode'].'</h7>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <h7 id ="item_dis">'.$item_row['name'].'</h7>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
?>