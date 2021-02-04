
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from dashboard-------------------*/
    $item1_qr = $_POST['itemqr'];
    /*--------------- item--------------------*/
    $item = "SELECT * FROM item WHERE barcode ='$item1_qr'";
    $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
    $item_result_row = $item_result-> fetch_assoc();

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
                                    <img class="item_qr_img" src="'.$item_result_row['qr'].'">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <p id ="item_name">'.$item_result_row['barcode'].'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
?>