
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from dashboard-------------------*/
    $main_id = $_POST['maimid'];

    /*--------------- maintenance--------------------*/
    $main = "SELECT * FROM maintenance WHERE maintenance_id = '$main_id'";
    $main_result = mysqli_query($conn, $main) or die (mysqli_error($conn));
    $main_result_row = $main_result-> fetch_assoc();

   echo' 
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel"><div id="comform_tital">Approve This</div></h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="exphp/apprucom.php" method="post" enctype = "multipart/form-data">
         <div class="modal-body">
           
             <div class="form-group">
              <p>Problem : '.$main_result_row['maintenance_note'].'</p>
             </div>
             <div class="form-group">
               <label for="message-text" class="col-form-label">Approve Note:</label>
               <textarea class="form-control" id="message-text" name="app_note"></textarea>
               <input type="text" hidden="" name="main_id" value="'.$main_id.'">
               <input type="text" hidden="" name="app_user" value="'.$log_user_id.'">
               <input type="text" hidden="" name="app_user_state" value="'.$user_position.'">
             </div>
           
         </div>
         <div class="modal-footer">';
         if($user_position == "Warden"){
            echo'<button type="submit" name="submit2" class="btn btn-primary">Appru For AR</button>';
          }else{
            echo'<button type="submit" name="submit1" class="btn btn-primary">Apprue</button>';
           if($main_result_row['state'] != 'NewAr'){
            echo'<button type="submit" name="submit2" class="btn btn-primary">Send Ar</button>';
           }
           echo'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
          }
         echo'</div>
         </form>
       </div>
    ';

    ?>