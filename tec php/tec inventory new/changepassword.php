<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 

  $user_id = "";
  $user_name = "";

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
  }else{
    echo '<script type="text/javascript">';
      echo 'alert("You can\'t accses this page...")';
    echo '</script>';
    header('Location:dashboard.php');
  }

?>

<?php 

  $error=array();
  $lenth_error=array();

  if (isset($_POST['submit'])) {
    //check empty fild......
    $req_field = array('oldpass','newpass','rnewpass');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('oldpass'=>12,'newpass'=>12,'rnewpass'=>12);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    $oldpass=mysqli_real_escape_string($conn,$_POST['oldpass']);
    $newpass=mysqli_real_escape_string($conn,$_POST['newpass']);
    $rnewpass=mysqli_real_escape_string($conn,$_POST['rnewpass']);

    $oldpassword = md5($oldpass);
    $query = "SELECT password FROM staff WHERE staff_id='{$user_id}' LIMIT 1";
    $result = mysqli_query($conn,$query);
    if ($result) {
      if (mysqli_num_rows($result)==1) {
        while ($detail = mysqli_fetch_assoc($result)) {
          $dbpassword = $detail['password'];
        }
      }else{
        $query = "SELECT password FROM student WHERE student_id='{$user_id}' LIMIT 1";
        $result = mysqli_query($student_conn,$query);
        if ($result) {
          if (mysqli_num_rows($result)==1) {
            while ($detail = mysqli_fetch_assoc($result)) {
              $dbpassword = $detail['password'];
            }
          }else{
            $error[]="Session error!!!";
          }
        }
      }
    }
    if ($oldpassword!=$dbpassword) {
      $error[]="Old password is Wrong!!!";
    }

    if ($newpass!=$rnewpass) {
      $error[]="Passwords are not maching...";
    }

    $password = md5($newpass);

    if (empty($error)&&empty($lenth_error)) {
      $user ="";
      if (isset($_SESSION['job_position'])) {
        $user = $_SESSION['job_position'];
        //echo ($user);
        if ($user=="Student") {
          $query = "UPDATE student SET password='{$password}' WHERE student_id='{$user_id}' LIMIT 1";
        }else{
          $query = "UPDATE staff SET password='{$password}' WHERE staff_id='{$user_id}' LIMIT 1";
        }
        $result = mysqli_query($conn,$query);
        if ($result) {
          //update is succed....
          echo '<script type="text/javascript">';
            echo 'alert("Update is succed...")';
            echo "window.location.href = 'userprofile.php'";
          echo '</script>';
          header('Location:userprofile.php');
          
        }else{
          echo '<script type="text/javascript">';
            echo 'alert("Update is not succed !!!")';
          echo '</script>';
        }
      }else{
        echo '<script type="text/javascript">';
            echo 'alert("can\'t identify user!!!")';
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
              <img id="user_img" src=<?php getimage();?>>
          </div>
        </a>
        <a href="userprofile.php" class="simple-text logo-normal">
          <p id="user_name"><?php echo $user_name ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php
              if (isset($_SESSION['job_position'])) {
                if ($_SESSION['job_position'] != "student") {
                  echo "<li class=\"\">";
                    echo "<a href=\"dashboard.php\">";
                      echo "<i class=\"nc-icon nc-badge\"></i>";
                      echo "<p>dashboard</p>";
                   echo "</a>";
                 echo "</li>";
                }
              }

          ?>
            <li class="active">
              <a href="userprofile.php">
                <i class="nc-icon nc-badge"></i>
                <p>Profile</p>
              </a>
            </li>
            
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Change Password</a>
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
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" name="oldpass" class="form-control" placeholder="Old password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Re-Enter New Password</label>
                        <input type="password" name="rnewpass" id="rnewpass" class="form-control" placeholder="Re Enter New Password">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" onclick="return confirm('Are you sure do you want to Change')" class="btn btn-primary btn-round">Change</button>
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
      $("#rnewpass").keyup(function(){
        if ($("#newpass").val()!=$("#rnewpass").val()) {
          $("#rnewpass").css("border-color", "red");
          $("#newpass").css("border-color", "red");

          //alert("Passwords not matching...");
          $("#rnewpass").focus();
        }else{
          $("#rnewpass").css("border-color", "#dcdcdc");
          $("#newpass").css("border-color", "#dcdcdc");
        }
      });
    });
  </script>
</body>

</html>
