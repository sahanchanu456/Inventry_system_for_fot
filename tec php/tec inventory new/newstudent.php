<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  $id="";
  $rawpassword="";
  $rpassword="";
  $fullname="";
  $phone="";
  $mail="";
  $year="";
  $department="";


  $error=array();
  $lenth_error=array();

  if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $year = substr($id, 3, 4);
  }else{
    echo '<script type="text/javascript">';
      echo 'alert("Id is not passed...")';
      echo 'window.location.replace("tecmiss.php");';
    echo '</script>';
  }

  if (isset($_POST['submit'])) {
    //check empty fild......
    $req_field = array('rawpassword','fullname','phone','mail','department');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('rawpassword'=>12,'fullname'=>50,'phone'=>11,'mail'=>50);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $year=mysqli_real_escape_string($conn,$_POST['year']);
    $rawpassword=mysqli_real_escape_string($conn,$_POST['rawpassword']);
    $rpassword=mysqli_real_escape_string($conn,$_POST['rpassword']);
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
    $department=mysqli_real_escape_string($conn,$_POST['department']);
    $image=mysqli_real_escape_string($conn,'img/user/user'.$_FILES['image']['name']);

    if ($rpassword!=$rawpassword) {
      $error[]="passwords are not matching!!!";
    }
    if ($id=="") {
      $error[]="Id didn't passed!!!";
      echo '<script type="text/javascript">';
        echo 'alert("Id is not passed...")';
        echo 'window.location.replace("tecmiss.php");';
      echo '</script>';
    }

    if (preg_match("!image!",$_FILES['image']['type'])) {
      if (copy($_FILES['image']['tmp_name'],$image)) {
        //image passing success....
      }
    }else{
      $error[]="invalid image type";
    }

    $password = md5($rawpassword);

    $query = "SELECT student_id FROM student WHERE student_id='".$id."'";
    $result = mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0) {
      $error[]="This id is already used";
    }

    

    if (empty($error)&&empty($lenth_error)) {
      //$today=date('Y-m-d h:i:s');
      $query = "INSERT INTO student(student_id,name,year,department_id,telephone,email,email_verification,password,image) VALUE('{$id}','{$fullname}','{$year}','{$department}','{$phone}','{$mail}',1,'{$password}','{$image}')";
      $result = mysqli_query($conn,$query);
      if ($result) {
        //register is succed....

        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $fullname;
        $_SESSION['job_position'] = "Student";
        $_SESSION['department_id'] = $department;
        $query = "SELECT name FROM department WHERE department_id='".$department."' LIMIT 1";
        $result = mysqli_query($conn,$query);
        if ($result) {
          if (mysqli_num_rows($result)==1) {
            while ($detail=mysqli_fetch_assoc($result)) {
              $_SESSION['dep_name'] = $detail['department_id'];
            }
          }
        }
                
        $id="";
        $password="";
        $fullname="";
        $phone="";
        $mail="";

        header('Location:index.php');
      }else{
        $error[]='not success!!!';
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
        <a href="index.php" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src="img/teclog.png">
          </div>
        </a>
        <a href="index.php" class="simple-text logo-normal">
          <p id="user_name"></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          
          <li>
            <a href="userprofile.php">
              <i class="nc-icon nc-badge"></i>
              <p>User Profile</p>
            </a>
          </li>
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
                <form action="newstudent.php" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <label>Account Id</label>
                        <input type="text" name="" class="form-control" disabled="" placeholder="Acc. ID" <?php echo 'value="'.$id.'"';?>>
                        <input type="hidden" name="id" <?php echo 'value="'.$id.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="" class="form-control" disabled="" placeholder="year" <?php echo 'value="'.$year.'"';?>>
                        <input type="hidden" name="year" <?php echo 'value="'.$year.'"';?>>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
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
                    <div class="col-md-7 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="mail" class="form-control" placeholder="Email" <?php echo 'value="'.$mail.'"';?>>
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-6 pl-2">
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
                    <div class="col-md-6 pl-2">
                      <div class="form-group">
                        <label>Choose immage</label>
                        <label class="form-control">.jpg</label>
                        <input type="file" name="image" accept="image/*">
                      </div>
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="rawpassword" class="form-control" id="password" placeholder="Password" <?php echo 'value="'.$rawpassword.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Re-Enter Password</label>
                        <input type="password" name="rpassword" class="form-control" id="rpassword" placeholder="Re-enter password" <?php echo 'value="'.$rpassword.'"';?>>
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

  <script>
    $(document).ready(function(){
      $("#rpassword").keyup(function(){
        if ($("#password").val()!=$("#rpassword").val()) {
          $("#rpassword").css("border-color", "red");
          $("#password").css("border-color", "red");

          //alert("Passwords not matching...");
          $("#rpassword").focus();
        }else{
          $("#rpassword").css("border-color", "#dcdcdc");
          $("#password").css("border-color", "#dcdcdc");
        }
      });
    });
  </script>
</body>

</html>
