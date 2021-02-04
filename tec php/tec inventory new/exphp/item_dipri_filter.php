
<?PHP include '../connection.php' ?>
<?php
$today = date("Y-m-d");
$catagory = $_POST['cat_N'];
$subcatagory = $_POST['subcat_N'];

if(($catagory == "0") && ($subcatagory == "0")){
    $item = "SELECT * FROM item";
    $item_result = mysqli_query($conn, $item);
}else{
    if(($catagory != "0") && ($subcatagory == "0")){
        $item = "SELECT * FROM item WHERE catagory = '$catagory'";
        $item_result = mysqli_query($conn, $item);
    }else{
        if(($catagory == "0") && ($subcatagory != "0")){
            $item = "SELECT * FROM item WHERE sub_catagory = '$subcatagory'";
            $item_result = mysqli_query($conn, $item);
        }else{
            if(($catagory != "0") && ($subcatagory != "0")){
                $item = "SELECT * FROM item WHERE catagory = '$catagory' AND sub_catagory = '$subcatagory'";
                $item_result = mysqli_query($conn, $item);
            }else{
                
            }
        }
    }
}

if(mysqli_num_rows($item_result)>0){
  while($item_row=mysqli_fetch_assoc($item_result)){
    $item_id = $item_row['item_id'];
      echo '
        <tr>
        <td>
          '.$item_row['model_id'].'         
        </td>
        <td>
          '.$item_row['name'].'        
        </td>
        <td>
          '.$item_row['date'].'         
        </td>
        <td>
          '.$item_row['warranty'].'     
        </td>
        <td>
          '.$item_row['name'].'
        </td>
        <td>
          '.$item_row['purchesed_companty'].'       
        </td>
        <td>
          RS .'.$item_row['price'].'       
        </td>
        <td>
          '.$item_row['invoice_no'].'      
        </td>
        <td>
          '.$item_row['serial_number'].'        
        </td>
        <td>
          '.$item_row['current_department'].'        
        </td>
        <td>
          '.$item_row['GRN_no'].'      
        </td>
        <td>
          '.$item_row['current_state'].'                               
        </td>
        <td class="exper_table">';
        
        $date1=date_create($today);
        $date2=date_create($item_row['date']);
        $diff=date_diff($date2,$date1);
        $y_count = $diff->format("%y");

        $depriciation = ($item_row['price']*$item_row['depreciation']/100);
        echo "RS. ".$depriciation;

        echo'</td> 
      </tr>';
  }
} 

?>