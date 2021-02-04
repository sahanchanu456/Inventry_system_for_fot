<?PHP include '../connection.php';?>

<?php
   $cdp = $_GET['qrcode'];
   $today= date("Y-m-d");

   $code_detal="SELECT * FROM item WHERE barcode = '$cdp'";
    $item_result=mysqli_query($conn,$code_detal) or die (mysql_error($conn)); 
    $code_detal_result=$item_result->fetch_assoc();
  



 echo '<tr>
                          <td>
                             '.$today.'         
                          </td>
                          <td>
                             '.$code_detal_result['item_id'].'
                             <input type="hidden" name="itemid" value="'.$code_detal_result['item_id'].'"> </input>     
                          </td>
                          <td>
                              '.$code_detal_result['name'].'          
                          </td>
                          <td>
                              '.$code_detal_result['current_department'].'      
                          </td>
                          <td>
                             '.$code_detal_result['model_id'].' 
                          </td>
                           <td>
                             '.$code_detal_result['catagory'].' 
                          </td>
                            <td>
                              '.$code_detal_result['sub_catagory'].'        
                            </td>
                            <td>
                              '.$code_detal_result['move_sate'].'        
                            </td>
                            <td>
                              '.$code_detal_result['warranty'].'      
                            </td>
                            <td>
                              '.$code_detal_result['add_user'].'        
                          </td>
                          <td>
                              '.$code_detal_result['move_sate'].'       
                          </td>
                            
                         <td>
                             '.$code_detal_result['current_department'].'
                         </td>
                          
                         <td>
                             '.$code_detal_result['current_state'].'
                         </td>
                   
                            </tr> 
                            </form>               
                       ';

?>
