<?PHP include '../connection.php';?>

<?php
  /*------get pass value------*/
  $subcatecory= $_POST['cat_N'];
  $model= $_POST['model_N'];


  if(($subcatecory == "0") && ($model == "0")){
    $item_filter="SELECT * FROM item";
    $item_filter_result=mysqli_query($conn,$item_filter) or die (mysql_error($conn)); 
  }else{
    if(($subcatecory == "0") && ($model != "0")){
    $item_filter="SELECT * FROM item WHERE model_id = '$model'";
    $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn));  
    }else{
      if(($subcatecory != "0") && ($model != "0")){
        $item_filter="SELECT * FROM item WHERE model_id = '$model' AND sub_catagory = '$subcatecory'";
        $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn));  
        }else{
          if(($subcatecory != "0") && ($model == "0")){
            $item_filter="SELECT * FROM item WHERE sub_catagory = '$subcatecory'";
            $item_filter_result = mysqli_query($conn,$item_filter) or die (mysql_error($conn));  
            }else{
              
            }
        }
    }
  }

  if(mysqli_num_rows($item_filter_result ) > 0){
      while ($item_filter_row = $item_filter_result-> fetch_assoc()){
                                  
                                  echo'
                                    <tr>
                                    <td>
                                      '.$item_filter_row['item_id'].'          
                                    </td>
                                    <td>
                                        '.$item_filter_row['barcode'].'      
                                    </td>
                                    <td>
                                       '.$item_filter_row['name'].'        
                                    </td>
                                    <td>
                                       '.$item_filter_row['description'].'     
                                    </td>
                                    <td>
                                      '.$item_filter_row['price'].'
                                    </td>
                                    <td>
                                      '.$item_filter_row['serial_number'].'       
                                    </td>
                                    <td>
                                        '.$item_filter_row['model_id'].'      
                                    </td>
                                    <td>
                                         '.$item_filter_row['invoice_no'].'     
                                    </td>
                                    <td>
                                      '.$item_filter_row['warranty'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['date'].'       
                                    </td>
                                    <td>
                                       '.$item_filter_row['purchesed_companty'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['inventory_page_no'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['current_department'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['GRN_no'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['move_sate'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['owner_department'].'      
                                    </td>
                                    <td>
                                      '.$item_filter_row['current_state'].'      
                                    </td>
                                    <td class=\"text-right\"> 
                                      '.$item_filter_row['add_user'].'  
                                    </td>
                                    </tr>';
                            }
                          }else{
                            $error="table empty";  
                          }       
?>