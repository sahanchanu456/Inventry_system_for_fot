
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
            while ($item_sear_row = $item_sear_result-> fetch_assoc()){
            $numcount = $numcount + 1;
            $item_id = $item_sear_row['item_id'];
            $date_today=date("Y-m-d");
            echo'<tr>
                    <td>
                    '.$numcount.'          
                    </td>
                    <td>
                    '.$item_sear_row['item_id'].'       
                    </td>
                    <td>
                    '.$item_sear_row['barcode'].'      
                    </td>
                    <td>
                    '.$item_sear_row['name'].'     
                    </td>
                    <td>
                    '.$item_sear_row['description'].'
                    </td>
                    <td>
                    '.$item_sear_row['price'].'      
                    </td>
                    <td>
                    '.$item_sear_row['serial_number'].'      
                    </td>
                    <td>
                    '.$item_sear_row['model_id'].'      
                    </td>
                    <td>
                    '.$item_sear_row['catagory'].'      
                    </td>
                    <td>
                    '.$item_sear_row['sub_catagory'].'      
                    </td>
                    <td>
                    '.$item_sear_row['invoice_no'].'       
                    </td>';
                    if($item_sear_row['warranty'] > $date_today){
                        echo'<td class="no_exper_table">
                            '.$item_sear_row['warranty'].'
                        </td>';
                    }else{
                        echo'<td class="exper_table">
                            '.$item_sear_row['warranty'].'
                        </td>';
                    }
                    echo'<td>
                    '.$item_sear_row['date'].'
                    </td>
                    <td>
                    '.$item_sear_row['purchesed_companty'].'      
                    </td>
                    <td>
                    '.$item_sear_row['inventory_page_no'].' 
                    </td>
                    <td>
                    '.$item_sear_row['current_department'].' 
                    </td>
                    <td>
                    '.$item_sear_row['GRN_no'].'      
                    </td>';
                    if($item_sear_row['move_sate'] == "move"){
                        echo'<td class="exper_table">
                            Move
                        </td>';
                    }else{
                        echo'<td class="no_exper_table">
                            Not Move
                        </td>';
                    }
                    echo'<td>
                    '.$item_sear_row['owner_department'].'    
                    </td>
                    <td>
                    '.$item_sear_row['add_user'].'     
                    </td>
                    <td>
                    '.$item_sear_row['current_state'].'     
                    </td>
                    <td class="text-right">
                    <a href=""><button type="button" class="shipp_button">PDF</button></a>       
                    </td>
                    <td class="text-right">
                    <a href="searchimge.php?item_id='.$item_id.'" class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                    </td>
                </tr>'; 
            }                
        }else{
            $error = "Table Emty";
        }
    }else{
        if($user_position == "Warden"){
            /*--------------------item table-------------------------*/ 
        if(mysqli_num_rows($item_sear_result ) > 0){
            /*-------------diaplay item ---------------*/
            while ($item_sear_row = $item_sear_result-> fetch_assoc()){
            $numcount = $numcount + 1;
            $item_id = $item_sear_row['item_id'];
            $date_today=date("Y-m-d");
            echo'<tr>
                    <td>
                    '.$numcount.'          
                    </td>
                    <td>
                    '.$item_sear_row['item_id'].'       
                    </td>
                    <td>
                    '.$item_sear_row['barcode'].'      
                    </td>
                    <td>
                    '.$item_sear_row['name'].'     
                    </td>
                    <td>
                    '.$item_sear_row['description'].'
                    </td>
                    <td>
                    '.$item_sear_row['price'].'      
                    </td>
                    <td>
                    '.$item_sear_row['serial_number'].'      
                    </td>
                    <td>
                    '.$item_sear_row['model_id'].'      
                    </td>
                    <td>
                    '.$item_sear_row['catagory'].'      
                    </td>
                    <td>
                    '.$item_sear_row['sub_catagory'].'      
                    </td>
                    <td>
                    '.$item_sear_row['current_department'].' 
                    </td>
                    <td>
                    '.$item_sear_row['owner_department'].'    
                    </td>
                    <td>
                    '.$item_sear_row['current_state'].'     
                    </td>
                    <td class="text-right">
                    <a href="searchimge.php?item_id='.$item_id.'" class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                    </td>
                </tr>'; 
            }                
        }else{
            $error = "Table Emty";
        }
        }else{
            if($user_position == "Student" || $user_position == "Lecture"){
                /*--------------------item table-------------------------*/ 
        if(mysqli_num_rows($item_sear_result ) > 0){
            /*-------------diaplay item ---------------*/
            while ($item_sear_row = $item_sear_result-> fetch_assoc()){
            $numcount = $numcount + 1;
            $item_id = $item_sear_row['item_id'];
            $date_today=date("Y-m-d");
            echo'<tr>
                    <td>
                    '.$numcount.'          
                    </td>
                    <td>
                    '.$item_sear_row['barcode'].'      
                    </td>
                    <td>
                    '.$item_sear_row['name'].'     
                    </td>
                    <td>
                    '.$item_sear_row['description'].'
                    </td>
                    <td>
                    '.$item_sear_row['serial_number'].'      
                    </td>
                    <td>
                    '.$item_sear_row['model_id'].'      
                    </td>
                    <td>
                    '.$item_sear_row['current_department'].' 
                    </td>
                    <td>
                    '.$item_sear_row['owner_department'].'    
                    </td>
                    <td>
                    '.$item_sear_row['current_state'].'     
                    </td>
                    <td class="text-right">
                    <a href="searchimge.php?item_id='.$item_id.'" class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
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
