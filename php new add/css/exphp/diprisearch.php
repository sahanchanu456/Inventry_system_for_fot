
<?PHP include '../connection.php' ?>
<?php
  
    $numcount ="0";
    $today = date("Y-m-d");
    /*-----------get pass value------------*/
    $searchtxt = $conn->real_escape_string($_GET["search"]);

    /*---------------------item search-------------------*/
    if( $searchtxt != " "){
        /*--------------- item--------------------*/
        $item_sear = "SELECT * FROM item WHERE barcode LIKE '%$searchtxt%' OR name LIKE '%$searchtxt%' OR serial_number LIKE '%$searchtxt%' OR model_id LIKE '%$searchtxt%' OR invoice_no LIKE '%$searchtxt%'";
        $item_sear_result = mysqli_query($conn, $item_sear) or die (mysqli_error($conn));
    
    }else{

    }

    if($user_position == "Admin" || $user_position == "AB" || $user_position == "Head" || $user_position == "TO" || $user_position == "Servei"){
        /*--------------------item table-------------------------*/ 
        if(mysqli_num_rows($item_sear_result ) > 0){
            /*-------------diaplay item ---------------*/
            while ($item_dip_sear_row = $item_sear_result-> fetch_assoc()){
            $numcount = $numcount + 1;
            $item_id = $item_dip_sear_row['item_id'];
            $date_today=date("Y-m-d");
            echo '
                        <tr>
                        <td>
                          '.$item_dip_sear_row['model_id'].'         
                        </td>
                        <td>
                          '.$item_dip_sear_row['name'].'        
                        </td>
                        <td>
                          '.$item_dip_sear_row['date'].'         
                        </td>
                        <td>
                          '.$item_dip_sear_row['warranty'].'     
                        </td>
                        <td>
                          '.$item_dip_sear_row['name'].'
                        </td>
                        <td>
                          '.$item_dip_sear_row['purchesed_companty'].'       
                        </td>
                        <td>
                          RS .'.$item_dip_sear_row['price'].'       
                        </td>
                        <td>
                          '.$item_dip_sear_row['invoice_no'].'      
                        </td>
                        <td>
                          '.$item_dip_sear_row['serial_number'].'        
                        </td>
                        <td>
                          '.$item_dip_sear_row['current_department'].'        
                        </td>
                        <td>
                          '.$item_dip_sear_row['GRN_no'].'      
                        </td>
                        <td>
                          '.$item_dip_sear_row['current_state'].'                               
                        </td>
                        <td class="exper_table">';
                        
                        $date1=date_create($today);
                        $date2=date_create($item_dip_sear_row['date']);
                        $diff=date_diff($date2,$date1);
                        $y_count = $diff->format("%y");

                        $depriciation = ($item_dip_sear_row['price']*$item_dip_sear_row['depreciation']/100);
                        echo "RS. ".$depriciation;

                        echo'</td> 
                      </tr>'; 
            }                
        }else{
            $error = "Table Emty";
        }
    }else{
       
    }
    
?>
