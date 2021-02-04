<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  check_admin();

?>

<?php 
  $id="";
  $password="12345";
  $fullname="";
  $phone="";
  $mail="";
  $job_roll="";
  $department="";
  $state="";


  $error=array();
  $lenth_error=array();


  if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn,$_GET['id']);

    $get_detail = "SELECT * FROM staff WHERE staff_id = '{$id}' LIMIT 1";
    $result_get_detail = mysqli_query($conn,$get_detail);
    if ($result_get_detail) {
      if (mysqli_num_rows($result_get_detail)==1) {
        while ($detail = mysqli_fetch_assoc($result_get_detail)) {
          $fullname=$detail['name'];
          $phone=$detail['telephone'];
          $mail=$detail['email'];
          $job_roll=$detail['job_position'];
          $department=$detail['department_id'];
          $state=$detail['state'];
        }
      }else{
        echo '<script type="text/javascript">'; 
        echo 'alert("Your selected ID is not matching...");'; 
        echo 'window.location.href = "mangeuser.php";';
        echo '</script>';
      }
    }

    
  }else{
    header('Location:mangeuser.php');
  }

  if (isset($_POST['submit'])) {
    //check empty fild......
    $req_field = array('fullname','phone','mail','type','department','state');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('fullname'=>50,'phone'=>11,'mail'=>50);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    //$id=mysqli_real_escape_string($conn,$_POST['id']);
    //$rawpassword=mysqli_real_escape_string($conn,$_POST['password']);
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
    $type=mysqli_real_escape_string($conn,$_POST['type']);
    $department=mysqli_real_escape_string($conn,$_POST['department']);
    $state=mysqli_real_escape_string($conn,$_POST['state']);

    

    if (empty($error)&&empty($lenth_error)) {
      //$today=date('Y-m-d h:i:s');
      $query = "UPDATE staff SET name='{$fullname}', job_possession='{$type}', department_id='{$department}', telephone='{$phone}', email='{$mail}', state='{$state}' WHERE staff_id='{$id}' LIMIT 1";
      $result = mysqli_query($conn,$query);
      if ($result) {
        //register is succed....
        $id="";
        $password="12345";
        $fullname="";
        $phone="";
        $mail="";

        echo '<script type="text/javascript">'; 
        echo 'alert("Update is succed...");'; 
        echo 'window.location.href = "mangeuser.php";';
        echo '</script>';
        
      }
    }
  }

 ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Manage User</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <!--------font & Awesome icon link down----------->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="demo/demo.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="userprofile.php" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src=<?php getimage(); ?>>
          </div>
        </a>
        <a href="userprofile.php" class="simple-text logo-normal">
          <p id="user_name"><?php echo $_SESSION['user_name']; ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php require_once('menu.php'); ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Edit User</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <?php navigation($conn); ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title"></h5>
                <p class="error"><?php print_error($error,$lenth_error); ?></p>
              </div>
                <p class="error"></p>
              <div class="card-body">
                <form action="" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Account Id:</label>
                        <input type="text" class="form-control" disabled="" placeholder="Acc. ID" <?php echo 'value="'.$id.'"';?>>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-11">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" <?php echo 'value="'.$fullname.'"';?>>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                      <label>Tel No:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Tel No:" <?php echo 'value="'.$phone.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="mail" class="form-control" placeholder="Email" <?php echo 'value="'.$mail.'"';?>>
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-4 pl-2">
                      <div class="form-group">
                        <label>Account Type</label>
                        <select class="form-control" name="type">
                            <option value="" <?php if($job_roll == ''): ?> selected="selected"<?php endif; ?>>No Select</option>
                            <option value="Admin" <?php if($job_roll == 'Admin'): ?> selected="selected"<?php endif; ?>>Admin</option>
                            <option value="Department Head"  <?php if($job_roll == 'Department Head'): ?> selected="selected"<?php endif; ?>>Department Head</option>
                            <option value="Lecture" <?php if($job_roll == 'Lecture'): ?> selected="selected"<?php endif; ?>>Lecture</option>
                            <option value="TO" <?php if($job_roll == 'TO'): ?> selected="selected"<?php endif; ?>>TO</option>
                            <option value="Assistant TO" <?php if($job_roll == 'Assistant'): ?> selected="selected"<?php endif; ?>>Assistant TO</option>
                            <option value="Warden" <?php if($job_roll == 'Warden'): ?> selected="selected"<?php endif; ?>>Warden</option>
                            <option value="AB" <?php if($job_roll == 'AB'): ?> selected="selected"<?php endif; ?>>AB</option>
                            <option value="Electrician" <?php if($job_roll == 'Electrician'): ?> selected="selected"<?php endif; ?>>Electrician</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pl-2">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" name="department">
                                <option value="">No Select</option>
                                <?php
                                  $get_department = "SELECT * FROM department";
                                  $result_get_department = mysqli_query($conn,$get_department);
                                  if ($result_get_department) {
                                    while ($row = mysqli_fetch_assoc($result_get_department)) {
                                      if($department == $row['department_id']){
                                        echo "<option value=\"".$row['department_id']."\" selected=\"selected\">".$row['name']."</option>";
                                      }else{
                                        echo "<option value=\"".$row['department_id']."\">".$row['name']."</option>";
                                      }
                                    } 
                                  }
                                  
                                ?>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-3 pl-2">
                        <div class="form-group">
                            <label> Current Satate</label>
                            <select class="form-control" name="state">
                                <option value="">No Select</option>
                                <option value="WorKing" <?php if($state == 'WorKing'): ?> selected="selected"<?php endif; ?>>WorKing</option>
                                <option value="Retire" <?php if($state == 'Retire'): ?> selected="selected"<?php endif; ?>>Retire</option>
                            </select>
                          </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" onclick="return confirm('Are you sure do you want to Update')" class="btn btn-primary btn-round">Update</button>
                    </div>
                    <div class="update ml-auto mr-auto">
                      <a href="mangeuser.php">
                        <button type="button" name="cancel" onclick="return confirm('Are you sure do you want to cancel')" class="btn btn-primary btn-round">cancel</button>
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
                <span class="copyright">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This web site is made by <a href="#" target="_blank">FOT EMS Team </a>
                  </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js" type="text/javascript"></script>
  <script src="demo/demo.js"></script>
  <script type='text/javascript'>
  </script>

  <script type="text/javascript">
    document.getElementById("msm").setAttribute("class", "active");
  </script>
</body>

</php>
