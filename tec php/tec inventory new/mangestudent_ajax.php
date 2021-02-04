<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
if (isset($_SESSION['job_position'])) {
    $job_position = $_SESSION['job_position'];
    
  }else{
    header('Location:dashboard.php');
    //$job_position = "admin";
  }
 ?>

<?php 

  $position = "0";
  $removeall = array();

  $table = "";
  $table = "<table class=\"table\"><thead class=\" text-primary\"><form action=\"mangestudent.php\" method=\"post\">";
    $table .= "<tr>";
      $table .= "<th>Id</th><th>Name</th><th>Year</th><th>Department</th><th>Tel.No:</th><th>Email</th><th>Registered_Date</th>";
      if ($job_position == 'Admin') {
       $table .= "<th></th><th></th><th class=\"text-right\"></th>"; 
      }
    $table .= "</tr>";
  $table .= "</thead>";
  $table .= "<tbody id=\"tabel_body\">";
    $get_user_list = "SELECT * FROM student WHERE email_verification=1 ";

    if (isset($_POST['year'])) {
      $year = mysqli_real_escape_string($conn,$_POST['year']);
      $department = mysqli_real_escape_string($conn,$_POST['department']);

      if ($year!="0") {
        $get_user_list .= " AND year='".$year."'";
      }
      if ($department!="0") {
        $get_user_list .= " AND department_id='".$department."'";
      }
    }

    if (isset($_POST['department'])) {
      $year = mysqli_real_escape_string($conn,$_POST['year']);
      $department = mysqli_real_escape_string($conn,$_POST['department']);

      if ($year!="0") {
        $get_user_list .= " AND year='".$year."'";
      }
      if ($department!="0") {
        $get_user_list .= " AND department_id='".$department."'";
      }
    }

    if (isset($_POST['search'])) {
      $search = mysqli_real_escape_string($conn,$_POST['search']);
      $get_user_list .= " AND (student_id LIKE'%".$search."%' or name LIKE '%".$search."%' or telephone LIKE '%".$search."%' or email LIKE '%".$search."%' or registered_date LIKE '%".$search."%')";
    }

    if ($job_position!='Admin' && $job_position!='AB' && $job_position!='Electrision') {
      //$get_user_list .= " AND department_id='{$user_department_id}'";
    }

    $result = mysqli_query($conn,$get_user_list);
    if ($result) {
      while ($detail = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
          $table .= "<td>".$detail['student_id']."</td><td>".$detail['name']."</td><td>".$detail['year']."</td><td>".$detail['department_id']."</td><td>".$detail['telephone']."</td><td>".$detail['email']."</td><td>".$detail['registered_date']."</td>";
            if ($job_position == 'Admin') {
              
             $table .= "<td><a href=\"editstudent.php?id=".$detail['student_id']."\"><button type=\"button\" class=\"shipp_button\">Edit</button></a></td><td><a href=\"mangestudent.php?did=".$detail['student_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to Delete')\" class=\"shipp_button\">Delete</button></a></td><td><a href=\"passreset.php?stdid=".$detail['student_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to reset password')\" class=\"shipp_button\">Pass.reset</button></a></td>";
             
            }
        $table .= "</tr>";
        
        $removeall[] = $detail['student_id'];
      }
    }else{

    }
 

    $table.="</form></tbody></table>";

    $return['table']=$table;
//echo ($table);

    if (isset($_POST['removeall'])) {
      $count = 0;
      $fail = 0;
      foreach ($removeall as $value) {
        $query = "DELETE FROM student WHERE student_id = '{$value}' LIMIT 1";
        $result = mysqli_query($conn,$query);
        if ($result) {
          $count++;
        }else{
          $fail++;
        }
      }
        //count is sum of deleted student account.....
        //fail is sum of notdeleted student account.....
      $return['delete_result']="suceded - ".$count."/".count($removeall)."\nfailed - ".$fail."/".count($removeall);
      
    }
    echo json_encode($return);
?>
