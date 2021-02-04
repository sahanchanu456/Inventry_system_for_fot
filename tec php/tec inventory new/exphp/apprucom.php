
<?PHP include '../connection.php' ?>
<?php
if(isset($_POST["submit1"])){
    /*----------get form data------------------------*/
    $main_id = $conn->real_escape_string($_POST['main_id']);
    $user_id = $conn->real_escape_string($_POST['app_user']);
    $user_state = $conn->real_escape_string($_POST['app_user_state']);
    $note = $conn->real_escape_string($_POST['app_note']);
    $date_today=date("Y-m-d");
    /*----------form validation------------------------*/
    if(!empty($note)){
        $note = $note;
    }else{
        $note = "No Apprue Note";
    } 

    /*-----------up date maintenance-------------*/
    $update_main = "UPDATE maintenance SET apprue_user_id='$user_id', apprue_user_state='$user_state', apprue_user_note='$note', apprue_date='$date_today', state='$user_state' WHERE maintenance_id='$main_id'";
    $update_main_result = mysqli_query($conn, $update_main) or die (mysqli_error($conn));
     /*------load appruemain.php-------*/
     header('Location: ../appruemain.php');


}

if(isset($_POST["submit2"])){
    /*----------get form data------------------------*/
    $main_id = $conn->real_escape_string($_POST['main_id']);
    $user_id = $conn->real_escape_string($_POST['app_user']);
    $user_state = $conn->real_escape_string($_POST['app_user_state']);
    $note = $conn->real_escape_string($_POST['app_note']);
    $date_today=date("Y-m-d");
    /*----------form validation------------------------*/
    if(!empty($note)){
        $note = $note;
    }else{
        $note = "No Apprue Note";
    } 

    /*-----------up date maintenance-------------*/
    $update_main = "UPDATE maintenance SET state='NewAr' WHERE maintenance_id='$main_id'";
    $update_main_result = mysqli_query($conn, $update_main) or die (mysqli_error($conn));
     /*------load appruemain.php-------*/
     header('Location: ../appruemain.php');


}
  ?>