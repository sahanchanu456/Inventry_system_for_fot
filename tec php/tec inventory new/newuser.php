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

  if (isset($_POST['submit'])) {
    //check empty fild......
    $req_field = array('id','password','fullname','mail','job_roll','department');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('id'=>5,'password'=>12,'fullname'=>50,'mail'=>50);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
    $job_roll=mysqli_real_escape_string($conn,$_POST['job_roll']);
    $department=mysqli_real_escape_string($conn,$_POST['department']);
    //$state=mysqli_real_escape_string($conn,$_POST['state']);
    $image=mysqli_real_escape_string($conn,'img/user/staff'.$_FILES['image']['name']);
    
    $mdpassword = md5($password);

    if (strlen(trim($phone))!=10 || !is_int($phone)) {
      $error[]="invalid phone number";
    }

    $query = "SELECT staff_id FROM staff WHERE staff_id='".$id."'";
    $result = mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0) {
      $error[]="This id is already used";
    }

    $query = "SELECT name FROM staff WHERE name='".$fullname."'";
    $result = mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0) {
      $error[]="This person is already registered";
    }

    if (preg_match("!image!",$_FILES['image']['type'])) {
      if (copy($_FILES['image']['tmp_name'],$image)) {
        //image passing success....
      }
    }else{
      $error[]="invalid image type";
    }

    if (empty($error)&&empty($lenth_error)) {
      $today=date('Y-m-d h:i:s');
      $query = "INSERT INTO staff(staff_id,name,job_position,department_id,telephone,email,email_verification,state,registered_date,password,image) VALUE('{$id}','{$fullname}','{$job_roll}','{$department}','{$phone}','{$mail}',1,'WorKing','{$today}','{$mdpassword}','{$image}')";
      $result = mysqli_query($conn,$query);
      if ($result) {
        //register is succed....
        echo '<script type="text/javascript">';
          echo 'alert("register is succed...")';
        echo '</script>';
        $id="";
        $password="12345";
        $fullname="";
        $phone="";
        $mail="";
      }else{
        $error[]="Some invalid detail(s). Please manualy check!!!";
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
            <a class="navbar-brand" href="">Add New User</a>
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
                        <label>Account Id</label>
                        <input type="text" id="id" name="id" class="form-control" placeholder="Acc. ID" <?php echo 'value="'.$id.'"';?> >
                      </div>
                    </div>
                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" <?php echo 'value="'.$password.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-1 pl-0">
                      <label></label>
                      <div class="input-group-append">
                        <label id="visibility" style="margin-left: -55px; margin-top: 15px;">Show</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" <?php echo 'value="'.$fullname.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Image</label>
                        <label class="form-control">.jpg</label>
                        <input type="file" name="image" accept="image/*">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                      <label>Tel No:</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Tel No:" <?php echo 'value="'.$phone.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" placeholder="Email" <?php echo 'value="'.$mail.'"';?>>
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-6 pl-2">
                      <div class="form-group">
                        <label>Account Type</label>
                        <select class="form-control" name="job_roll" id="job_roll">
                            <option value="" <?php if($job_roll == ''): ?> selected="selected"<?php endif; ?>>No Select</option>
                            <option value="Admin" <?php if($job_roll == 'Admin'): ?> selected="selected"<?php endif; ?>>Admin</option>
                            <option value="Head"  <?php if($job_roll == 'Head'): ?> selected="selected"<?php endif; ?>>Department Head</option>
                            <option value="Lecture" <?php if($job_roll == 'Lecture'): ?> selected="selected"<?php endif; ?>>Lecture</option>
                            <option value="TO" <?php if($job_roll == 'TO'): ?> selected="selected"<?php endif; ?>>TO</option>
                            <option value="Assistant TO" <?php if($job_roll == 'Assistant'): ?> selected="selected"<?php endif; ?>>Assistant TO</option>
                            <option value="Warden" <?php if($job_roll == 'Warden'): ?> selected="selected"<?php endif; ?>>Warden</option>
                            <option value="Survay" <?php if($job_roll == 'Survay'): ?> selected="selected"<?php endif; ?>>Survay</option>
                            <option value="AB" <?php if($job_roll == 'AB'): ?> selected="selected"<?php endif; ?>>AB</option>
                            
                        </select>
                      </div>
                    </div>
                    <div class="col-md-5 pl-2">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" name="department" id="department">
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
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Register</button>
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
    document.getElementById("ansm").setAttribute("class", "active");

    $(document).ready(function(){
      //check id.......
      $("#id").keyup(function(){
        if ($("#id").val().length>5) {
          $("#id").css("border-color", "red");
        }else{
          $("#id").css("border-color", "#dcdcdc");
        }
      });
      //check password.......
      $("#password").keyup(function(){
        if ($("#password").val().length>12) {
          $("#password").css("border-color", "red");
        }else{
          $("#password").css("border-color", "#dcdcdc");
        }
      });
      //visibility password.......
      $("#visibility").click(function(){
        if ($("#password").attr('type')=='password') {
          $("#password").prop('type', 'text');
          $("#visibility").html('Hide');
        }else{
          $("#password").prop('type', 'password');
          $("#visibility").html('Show');
        }
      });
      //check name.......
      $("#fullname").keyup(function(){
        if ($("#fullname").val().length>50) {
          $("#fullname").css("border-color", "red");
        }else{
          $("#fullname").css("border-color", "#dcdcdc");
        }
      });
      //check phone.......
      $("#phone").keyup(function(){
        if ($("#phone").val()<0 || !$.isNumeric($("#phone").val()) || $("#phone").val().length>10) {
          $("#phone").css("border-color", "red");
        }else{
          $("#phone").css("border-color", "#dcdcdc");
        }
      });
      //auto set relevent department.............
      $("#job_roll").change(function(){
        if ($("#job_roll").val()=='Admin') {
          $("#department option[value='ADM']").attr("selected", "selected");
          //$("#department").prop("readonly", true);
        }else if ($("#job_roll").val()=='AB') {
          $("#department option[value='FINANCE']").attr("selected", "selected");
          //$("#department").prop("disabled", true);
        }else if ($("#job_roll").val()=='Warden') {
          $("#department option[value='HSTL']").attr("selected", "selected");
          //$("#department").prop("disabled", true);
        }else if ($("#job_roll").val()=='Survay') {
          $("#department option[value='ADM']").attr("selected", "selected");
          //$("#department").prop("disabled", true);
        }else{
          $("#department").prop("disabled", false);
        }

      });
    });
  </script>
</body>

</html>
