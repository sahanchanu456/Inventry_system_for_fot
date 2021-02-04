
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from dashboard-------------------*/
    $mainid = $_POST['maimid'];
    /*--------------- maintenance--------------------*/
    $maint = "SELECT * FROM maintenance WHERE maintenance_id = '$mainid'";
    $maint_result = mysqli_query($conn, $maint) or die (mysqli_error($conn));
    $maint_result_row = $maint_result-> fetch_assoc();

   echo' <div class="row">
            <div class="col-md-8">
                <div class="card card-user" id="dis_card">
                    <div class="card-header">
                        <p class="error"></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <p id ="item_dis">'.$maint_result_row['maintenance_note'].'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
?>