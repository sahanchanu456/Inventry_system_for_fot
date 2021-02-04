<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  $job_position ="";
  $tabel_body = "";
  $table_name = "";
  $table_head = "";
  $select = "";

  if (!isset($_SESSION['job_position'])) {
    header('Location:index.php');
  }else{
    $job_position = $_SESSION['job_position'];
  }

  if ($job_position=="Admin" || $job_position=="AB" || $job_position=="Survayperson") {
    $table_name = "All Inventry Item";
    $table_head = "<tr><th>Item Id</th><th>Item Name</th><th>Description</th><th>Add Date</th><th>Warranty</th><th>Model Name</th><th>Purchesed Companty</th><th>Price</th><th>Invoice No</th><th>Sirial No</th><th>Current Department</th><th>GRN</th><th class=\"text-right\">Current State</th></tr>";
    $query = "SELECT * FROM item";

    if (isset($_POST['selected'])) {
      $select = mysqli_real_escape_string($conn,$_POST['selected']);
      switch ($select) {
        case 'AII':
          $table_name = "All Inventry Item";
          $query = "SELECT * FROM item WHERE current_state NOT REGEXP '^-?[0-9]*\\.?[0-9]+([Ee][+-][0-9]+)?$'";
          break;
        case 'NSI':
          $table_name = "New Survey Item";
          $table_head = "<tr><th>surver_id</th><th>surve_id</th><th>date</th><th>item_id</th><th>item_name</th><th>item_department</th><th>model_name</th><th>catagory</th><th>move_state</th><th>warranty</th><th>add_user</th><th>move_department</th><th class=\"text-right\">current_department</th><th class=\"text-right\">current_state</th></tr>";
          $query = "SELECT * FROM surver_data";
          $result = mysqli_query($conn,$query);
          if ($result) {
            if (mysqli_num_rows($result)>0) {
              //create table body........
              while ($detail = mysqli_fetch_assoc($result)) {
                $tabel_body .= "<tr>";
                  $tabel_body .= "<td>".$detail['surver_id']."</td>";
                  $tabel_body .= "<td>".$detail['surve_id']."</td>";
                  $tabel_body .= "<td>".$detail['date']."</td>";
                  $tabel_body .= "<td>".$detail['item_id']."</td>";
                  $tabel_body .= "<td>".$detail['item_name']."</td>";
                  $tabel_body .= "<td>".$detail['item_department']."</td>";
                  $tabel_body .= "<td>".$detail['model_name']."</td>";
                  $tabel_body .= "<td>".$detail['catagory']."</td>";
                  $tabel_body .= "<td>".$detail['move_state']."</td>";
                  $tabel_body .= "<td>".$detail['warranty']."</td>";
                  $tabel_body .= "<td>".$detail['add_user']."</td>";
                  $tabel_body .= "<td>".$detail['move_department']."</td>";
                  $tabel_body .= "<td>".$detail['current_department']."</td>";
                  $tabel_body .= "<td>".$detail['current_state']."</td>";
                  
                $tabel_body.= "</tr>";
              }
            }
          }
          break;
        case 'MI':
          $table_name = "Missing Item";
          $query = "SELECT * FROM item WHERE item_id=(SELECT item_id FROM item WHERE current_state='using' EXCEPT (SELECT item_id FROM surver_data))";
          break;
        case 'DI':
          $table_name = "Distroid Item";
          $query = "SELECT * FROM item WHERE current_state='distroid'";
          break;
        case 'SI':
          $table_name = "Sell Item";
          $query = "SELECT * FROM item WHERE concat('',current_state * 1)";
          break;
        case 'WI':
          $table_name = "Warranty Item";
          $query = "SELECT * FROM item WHERE current_state='warranty'";
          break;
        case 'RI':
          $table_name = "Repayar Item";
          $query = "SELECT * FROM item WHERE current_state='repayar'";
          break;
        case 'SW':
          $table_name = "Ship to wellamadama";
          $query = "SELECT * FROM item WHERE current_state='wellamadama'";
          break;
        
        default:
          # code...
          break;
      }
      
    }
    if ($tabel_body=="") {
      $result = mysqli_query($conn,$query);
      if ($result) {
        if (mysqli_num_rows($result)>0) {
          //create table body........
          while ($detail = mysqli_fetch_assoc($result)) {
            $tabel_body .= "<tr>";
              $tabel_body .= "<td>".$detail['item_id']."</td>";
              $tabel_body .= "<td>".$detail['name']."</td>";
              $tabel_body .= "<td>".$detail['description']."</td>";
              $tabel_body .= "<td>".$detail['date']."</td>";
              $tabel_body .= "<td>".$detail['warranty']."</td>";
              $tabel_body .= "<td>".$detail['model_id']."</td>";
              $tabel_body .= "<td>".$detail['purchesed_companty']."</td>";
              $tabel_body .= "<td>".$detail['price']."</td>";
              $tabel_body .= "<td>".$detail['invoice_no']."</td>";
              $tabel_body .= "<td>".$detail['serial_number']."</td>";
              $tabel_body .= "<td>".$detail['current_department']."</td>";
              $tabel_body .= "<td>".$detail['GRN_no']."</td>";
              $tabel_body .= "<td>".$detail['current_state']."</td>";
              
            $tabel_body.= "</tr>";
          }
        }
      }
    }
    $return['title']=$table_name;
    $return['head']=$table_head;
    $return['body']=$tabel_body;

    echo json_encode($return);
  }else{
    header('Location:dashboard.php');
  }


 ?>

