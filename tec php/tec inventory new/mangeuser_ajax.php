<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  if (isset($_SESSION['user_id'])) {
    $job_position = $_SESSION['job_position'];
    $user_id = $_SESSION['user_id'];
    $department_id = $_SESSION['department_id'];
  }else{
    header('Location:dashboard.php');
    //$job_position = "admin";
  }

 ?>

<?php 

  $position = "0";

  $table = "";
    $table .= "<table class=\"table\"><thead class=\" text-primary\"><form action=\"mangeuser.php\" method=\"post\">";
    $table .= "<tr>";
      $table .= "<th>Id</th><th>Name</th><th>Account type</th><th>Department</th><th>Tel.No:</th><th>Email</th><th>Registered_Date</th>";
      if ($job_position == 'Admin') {
       $table .= "<th></th><th></th><th class=\"text-right\"></th>"; 
      }
    $table .= "</tr>";
  $table .= "</thead>";
  $table .= "<tbody id=\"tabel_body\">";
    $get_user_list = "SELECT * FROM staff WHERE state='WorKing'";

    if (isset($_POST['position'])||isset($_POST['department'])) {
      $position = mysqli_real_escape_string($conn,$_POST['position']);
      $department = mysqli_real_escape_string($conn,$_POST['department']);

      if ($position!="0") {
        $get_user_list .= " AND job_position='".$position."'";
      }
      if ($department!="0") {
        $get_user_list .= " AND department_id='".$department."'";
      }
    }

    if (isset($_POST['search'])) {
      $search = mysqli_real_escape_string($conn,$_POST['search']);
      $get_user_list .= " AND (staff_id LIKE'%".$search."%' or name LIKE '%".$search."%' or telephone LIKE '%".$search."%' or email LIKE '%".$search."%' or registered_date LIKE '%".$search."%')";
    }

    if ($job_position!='Admin' && $job_position!='AB' && $job_position!='Head') {
      $get_user_list .= " AND department_id='{$department_id}' ";
    }

    $result = mysqli_query($conn,$get_user_list);
    if ($result) {
      while ($detail = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
          $table .= "<td>".$detail['staff_id']."</td><td>".$detail['name']."</td><td>".$detail['job_position']."</td><td>".$detail['department_id']."</td><td>".$detail['telephone']."</td><td>".$detail['email']."</td><td>".$detail['registered_date']."</td>";
            if ($job_position == 'Admin') {
             $table .= "<td><a href=\"edituser.php?id=".$detail['staff_id']."\"><button type=\"button\" class=\"shipp_button\">Edit</button></a></td><td><a href=\"removemember.php?id=".$detail['staff_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to remove')\" class=\"shipp_button\">Remove</button></a></td><td><a href=\"passreset.php?stfid=".$detail['staff_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to reset password')\" class=\"shipp_button\">Pass.reset</button></a></td>"; 
            }
        $table .= "</tr>";
      }
    }else{

    }
    $table.="</form></tbody></table>";

    echo json_encode($table);
  


?>
