
<?PHP include '../connection.php' ?>
<?php
    /*----------------get pass id from dashboard-------------------*/
    $item_id = $_POST['itemid'];

    /*------item details for feed-----*/
    $item = "SELECT * FROM item WHERE item_id = '$item_id'";
    $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
    $item_row = $item_result-> fetch_assoc();

    
   echo' 
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><div id="comform_tital">Are You Sure? Remove This</div></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>QR : '.$item_row['barcode'].'</p>
          <p>Name : '.$item_row['name'].'</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
          <a href="exphp/removeitem.php?itemid='.$item_id.'"><button type="button" class="btn btn-primary">ok</button></a>
        </div>
      </div>';

    ?>