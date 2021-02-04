<?php require_once('connection.php') ?>

<?php 

if (session_status() == PHP_SESSION_NONE) {
  session_start();
} 

$_SESSION['user_id'] = NULL;
$_SESSION['user_name'] = NULL;
$_SESSION['job_position'] = NULL;
$_SESSION['dep_name'] = NULL;
$_SESSION['department_id'] = NULL;
$_SESSION['image'] = NULL;

$error=array();
$user_name="";
$user_department="";
$dep_name="";
$job_position="";
$image="";


if (isset($_POST['login'])) {

    if (empty($_POST['userid']) or empty($_POST['password'])) {
    
        $error[]= "please fill all filed";

    }else{
      $userid=mysqli_real_escape_string($conn,$_POST['userid']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $md_password=md5($password);

    $q1="SELECT * from student where student_id = '{$userid}' limit 1";
    $result1=mysqli_query($conn,$q1);

    $q2="SELECT * from staff where staff_id = '{$userid}' limit 1";
    $result2=mysqli_query($conn,$q2);

    if (mysqli_num_rows($result1)==1) {

      while ($detail = mysqli_fetch_assoc($result1)) {


              if($md_password==$detail['password']){
                $user_name=$detail['name'];
                $user_department=$detail['department'];
                $image=$detail['image'];
                $q3="SELECT name from department where department_id='{$user_department}'";
                $result4=mysqli_query($student_conn,$q3);
                if ($result4) {
                  while ($detail2 = mysqli_fetch_assoc($result4)) {
                      $dep_name=$detail2['name'];
                  }
                }
                $job_position='Student';
                header('Location:dashboard.php');
              }else{
                $error[]="invalid name or password";
              }
      }

      
    

      }else if (mysqli_num_rows($result2)==1) {
        while($detail = mysqli_fetch_assoc($result2)){
                if($md_password==$detail['password']){
                $user_name=$detail['name'];
                $user_department=$detail['department_id'];
                $image=$detail['image'];
                $q3="SELECT name from department where department_id='{$user_department}'";
                $result4=mysqli_query($lecture_conn,$q3);
                if ($result4) {
                  while ($detail2 = mysqli_fetch_assoc($result4)) {
                      $dep_name=$detail2['name'];
                  }
                }
                $job_position=$detail['job_position'];
                header('Location:dashboard.php');
                }else{
                  $error[]="invalid name or password";
                }
        }
      }else{
            $error[]="invalid name or password";
      }
      $_SESSION['user_id'] = $userid;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['job_position'] = $job_position;
      $_SESSION['dep_name'] = $dep_name;
      $_SESSION['department_id'] = $user_department;
      $_SESSION['image'] = $image;
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
  <title>RuhTecInventory.lk/LogUser</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--------font & Awesome icon link down----------->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!--------------CSS link ------------------------->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="demo/demo.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<body class="log_boby">
      <div class="log_form">
          <div class="col-md-10">
            <div class="card card-user">
              <div class="log_con">
                <div class="card-header">
                  <h5 class="log_tit">Log In For All User</h5>
                </div>
                <div class="card-body">
                  <form method="post" action="index.php">
                    <p class="error">
                      
                      <?php
                        foreach ($error as $value) {
                          echo $value;
                        }
                      ?>

                    </p>
                    <div class="row">
                      <div class="col-md-10 pr-1">
                        <div class="form-group">
                          <label>User ID</label>
                          <input type="text" class="form-control" name = "userid" id="form-control" placeholder="Enter User ID">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10 pr-1">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" id="form-control2" placeholder="Password">
                          <br>
                          <input type="checkbox" onclick="myFunction()">  Show Password

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="update ml-auto mr-4">
                        <button type="submit" class="btn btn-primary btn-round" name= "login" id="log_button">Log IN</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="left_box">
    <div class="welcome_ad">
      <div class="logo_sur">
        <img src="img/ruhlog.png" class="ruhlog"><img src="img/teclog.png" class="teclog">
      </div>
      <h1 class="welcome_h1">University of Ruhuna</h1>
      <h3 class="welcome_h2">Faculty of Technology</h3>
      <h2 class="welcome_h3">Inventory Management System</h2>
    </div>
  </div>
  <footer class="footer footer-black  footer-white " id="log_footer">
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
</body>

<script>

function myFunction() {
  var x = document.getElementById("form-control2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

</html>