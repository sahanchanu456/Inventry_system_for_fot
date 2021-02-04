
<?PHP include '../connection.php' ?>
<?php
    $numcount ="0";
    /*-----------get pass value------------*/
    $catagory= $_POST['cat_N'];
    $subcatagory= $_POST['subcat_N'];
    $model= $_POST['model_N'];

    /*---------------------item filter-------------------*/
    if(($catagory == "0") && ($subcatagory == "0") && ($model == "0")){
        /*--------------- item--------------------*/
        $item_fil = "SELECT * FROM item";
        $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
    }else{
        if(($catagory != "0") && ($subcatagory == "0") && ($model == "0")){
            $item_fil = "SELECT * FROM item WHERE catagory = '$catagory'";
            $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
        }else{
            if(($catagory != "0") && ($subcatagory != "0") && ($model == "0")){
                $item_fil = "SELECT * FROM item WHERE catagory = '$catagory' AND sub_catagory = '$subcatagory'";
                $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
            }else{
                if(($catagory != "0") && ($subcatagory != "0") && ($model != "0")){
                    $item_fil = "SELECT * FROM item WHERE catagory = '$catagory' AND sub_catagory = '$subcatagory' AND model_id = '$model'";
                    $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
                }else{
                    if(($catagory == "0") && ($subcatagory == "0") && ($model != "0")){
                        $item_fil = "SELECT * FROM item WHERE model_id = '$model'";
                        $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
                    }else{
                        if(($catagory == "0") && ($subcatagory != "0") && ($model != "0")){
                            $item_fil = "SELECT * FROM item WHERE model_id = '$model' AND sub_catagory = '$subcatagory'";
                            $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
                        }else{
                            if(($catagory == "0") && ($subcatagory != "0") && ($model == "0")){
                                $item_fil = "SELECT * FROM item WHERE sub_catagory = '$subcatagory'";
                                $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
                            }else{
                                if(($catagory != "0") && ($subcatagory == "0") && ($model != "0")){
                                    $item_fil = "SELECT * FROM item WHERE catagory = '$catagory' AND model_id = '$model'";
                                    $item_fil_result = mysqli_query($conn, $item_fil) or die (mysqli_error($conn));
                                }else{
                        
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if($user_position == "Admin" || $user_position == "AB" || $user_position == "Head" || $user_position == "TO" || $user_position == "Servei"){
    /*--------------------item table-------------------------*/ 
      if(mysqli_num_rows($item_fil_result ) > 0){
        /*-------------diaplay item ---------------*/
        while ($item_fil_row = $item_fil_result-> fetch_assoc()){
          $numcount = $numcount + 1;
          $item_id = $item_fil_row['item_id'];
          $barcode = $item_fil_row['barcode'];
          $date_today=date("Y-m-d");
          echo'<tr>
                <td>
                '.$numcount.'          
                </td>
                <td>
                '.$item_fil_row['item_id'].'       
                </td>
                <td data-qr='.$barcode.' class="qr_button">
                '.$item_fil_row['barcode'].'      
                </td>
                <td>
                '.$item_fil_row['name'].'     
                </td>
                <td>
                '.$item_fil_row['description'].'
                </td>
                <td>
                '.$item_fil_row['price'].'      
                </td>
                <td>
                '.$item_fil_row['serial_number'].'      
                </td>
                <td>
                '.$item_fil_row['model_id'].'      
                </td>
                <td>
                '.$item_fil_row['catagory'].'      
                </td>
                <td>
                '.$item_fil_row['sub_catagory'].'      
                </td>
                <td>
                '.$item_fil_row['invoice_no'].'       
                </td>';
                if($item_fil_row['warranty'] > $date_today){
                    echo'<td class="no_exper_table">
                        '.$item_fil_row['warranty'].'
                    </td>';
                }else{
                    echo'<td class="exper_table">
                        '.$item_fil_row['warranty'].'
                    </td>';
                }
                echo'<td>
                '.$item_fil_row['date'].'
                </td>
                <td>
                '.$item_fil_row['purchesed_companty'].'      
                </td>
                <td>
                '.$item_fil_row['inventory_page_no'].' 
                </td>
                <td>
                '.$item_fil_row['current_department'].' 
                </td>
                <td>
                '.$item_fil_row['GRN_no'].'      
                </td>';
                if($item_fil_row['move_sate'] == "move"){
                    echo'<td class="exper_table">
                        Move
                    </td>';
                }else{
                    echo'<td class="no_exper_table">
                        Not Move
                    </td>';
                }
                echo'<td>
                '.$item_fil_row['owner_department'].'    
                </td>
                <td>
                '.$item_fil_row['add_user'].'     
                </td>
                <td>
                '.$item_fil_row['current_state'].'     
                </td>
                <td class="text-right">
                <a href=""><button type="button" class="shipp_button">PDF</button></a>       
                </td>
                <td class="text-right">
                <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                </td>
            </tr>'; 
        }                
      }else{
        $error = "Table Emty";
      }
    }else{
        if($user_position == "Warden"){
            /*--------------------item table-------------------------*/ 
        if(mysqli_num_rows($item_fil_result ) > 0){
        /*-------------diaplay item ---------------*/
        while ($item_fil_row = $item_fil_result-> fetch_assoc()){
          $numcount = $numcount + 1;
          $item_id = $item_fil_row['item_id'];
          $barcode = $item_fil_row['barcode'];
          $date_today=date("Y-m-d");
          echo'<tr>
                <td>
                '.$numcount.'          
                </td>
                <td>
                '.$item_fil_row['item_id'].'       
                </td>
                <td data-qr='.$barcode.' class="qr_button">
                '.$item_fil_row['barcode'].'      
                </td>
                <td>
                '.$item_fil_row['name'].'     
                </td>
                <td>
                '.$item_fil_row['description'].'
                </td>
                <td>
                '.$item_fil_row['price'].'      
                </td>
                <td>
                '.$item_fil_row['serial_number'].'      
                </td>
                <td>
                '.$item_fil_row['model_id'].'      
                </td>
                <td>
                '.$item_fil_row['catagory'].'      
                </td>
                <td>
                '.$item_fil_row['sub_catagory'].'      
                </td>
                <td>
                '.$item_fil_row['current_department'].' 
                </td>
                <td>
                '.$item_fil_row['owner_department'].'    
                </td>
                <td>
                '.$item_fil_row['current_state'].'     
                </td>
                <td class="text-right">
                <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                </td>
            </tr>'; 
        }                
      }else{
        $error = "Table Emty";
      }
        }else{
            if($user_position == "Student" || $user_position == "Lecture"){
                    /*--------------------item table-------------------------*/ 
        if(mysqli_num_rows($item_fil_result ) > 0){
            /*-------------diaplay item ---------------*/
            while ($item_fil_row = $item_fil_result-> fetch_assoc()){
              $numcount = $numcount + 1;
              $item_id = $item_fil_row['item_id'];
              $barcode = $item_fil_row['barcode'];
              $date_today=date("Y-m-d");
              echo'<tr>
                    <td>
                    '.$numcount.'          
                    </td>
                    <td data-qr='.$barcode.' class="qr_button">
                    '.$item_fil_row['barcode'].'      
                    </td>
                    <td>
                    '.$item_fil_row['name'].'     
                    </td>
                    <td>
                    '.$item_fil_row['description'].'
                    </td>
                    <td>
                    '.$item_fil_row['serial_number'].'      
                    </td>
                    <td>
                    '.$item_fil_row['model_id'].'      
                    </td>
                    <td>
                    '.$item_fil_row['current_department'].' 
                    </td>
                    <td>
                    '.$item_fil_row['owner_department'].'    
                    </td>
                    <td>
                    '.$item_fil_row['current_state'].'     
                    </td>
                    <td class="text-right">
                    <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                    </td>
                </tr>'; 
            }                
          }else{
            $error = "Table Emty";
          }
            }else{

            }
        }
    }
    
?>
<div class="modal fade custom_search_pop" id="itemeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog" id="model_d" role="document">
        <div class="model_body">
        
        </div>
    </div>
  </div>
  <script type='text/javascript'>
        // load item details
         $(document).ready(function(){

            $('.img_button').click(function(){
   
                var itemid = $(this).data('itemid');
                // pass item id
                $.ajax({
                    url: 'exphp/itemdetail.php',
                    type: 'post',
                    data: {itemid: itemid},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>
  <script type='text/javascript'>
        // load qr
         $(document).ready(function(){

            $('.qr_button').click(function(){
   
                var itemqr = $(this).data('qr');
                // pass item qr
                $.ajax({
                    url: 'exphp/qrdisplay.php',
                    type: 'post',
                    data: {itemqr: itemqr},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>