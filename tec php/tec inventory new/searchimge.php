
<?PHP include 'connection.php' ?>
<?PHP
  $item_id = $conn->real_escape_string($_GET["item_id"]);


  if(!empty($log_user_id) && !empty($user_position)){
    if($user_position == "student"){
      /*---------------------login admin details-----------------------*/
      $log_user = "SELECT * FROM student WHERE student_id='$log_user_id'";
      $log_user_result = mysqli_query($conn, $log_user) or die (mysqli_error($conn));
      $row = $log_user_result-> fetch_assoc();
    }else{
      $log_user = "SELECT * FROM staff WHERE staff_id='staf01' AND job_possession='admin'";
      $log_user_result = mysqli_query($conn, $log_user) or die (mysqli_error($conn));
      $row = $log_user_result-> fetch_assoc();
    }
  }

  /*--------------- item--------------------*/
  $item = "SELECT * FROM item WHERE item_id='$item_id'";
  $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
  $item_result_row = $item_result-> fetch_assoc();

  /*---------------------mantence req count-----------------------*/
  $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' OR state = 'NewAr'";
  $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
  $main_count_row = $main_count_result-> fetch_assoc();
   
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Admin</title>
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
        <?PHP
          if(!empty($log_user_id) && !empty($user_position)){
            echo'<a href="userprofile.php" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img id="user_img" src="';
                if($row['image'] == NULL || $row['image'] == " "){
                  echo 'img\logo.png';
                }else{
                  echo $row['image'];
                }
            echo'">
           </div>
            </a>
            <a href="#Admi Acc. seting link karanna" class="simple-text logo-normal">
              <p id="user_name">'.$row['name'].'</p>
            </a>';
          }else{
            echo '<a href="index.php"><button type="button" class="loger_ser_button">Relog In</button></a>';
          }
        ?>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="dashboard.php">
              <i class="nc-icon nc-tv-2"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="appruemain.php">
              <i class="nc-icon nc-tap-01"></i>
              <p>Approve Maintenace</p>
            </a>
          </li>
          <li>
            <a href="userprofile.php">
              <i class="nc-icon nc-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li>
            <a href="itemcatagory.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Item & Catagory </p>
            </a>
          </li>
          <li>
            <a href="mangeuser.php">
              <i class="nc-icon nc-badge"></i>
              <p>Manage User</p>
            </a>
          </li>
          <li>
            <a href="feedback.php">
              <i class="nc-icon nc-chat-33"></i>
              <p>Feedback</p>
            </a>
          </li>
          <li>
            <a href="reportgenarate.php">
              <i class="nc-icon nc-chart-pie-36"></i>
              <p>Report Genarate</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="nc-icon nc-layout-11"></i>
              <p>Genarate Barcorde</p>
            </a>
          </li>
          <li>
            <a href="suplyer.php">
              <i class="nc-icon nc-ambulance"></i>
              <p>Suplyer</p>
            </a>
          </li>
          <li>
            <a href="maintenancereq.php">
              <i class="nc-icon nc-alert-circle-i"></i>
              <p>Repairing request</p>
            </a>
          </li>
          <li>
            <a href="survayform.php">
              <i class="nc-icon nc-paper"></i>
              <p>survey</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Image And QR</a></p>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="log out eka link karanna">
                  <i class="nc-icon nc-button-power"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="appruemain.php">
                <?php
                    if($main_count_row['COUNT(`maintenance_id`)'] > 0){
                      echo '<div class="notification_count"><p class="not_cou">'.$main_count_row['COUNT(`maintenance_id`)'].'</p></div><i class="nc-icon nc-bell-55"></i>';
                    }else{
                      echo '<i class="nc-icon nc-bell-55"></i>';
                    }
                  ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="">
                  <i class="nc-icon nc-settings-gear-65"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
      <div class="row">
            <div class="col-md-12">
                <div class="card card-user" id="dis_card">
                    <div class="card-header">
                        <p class="error"></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <img class="item_ditails_img" src="<?php echo $item_result_row['image']; ?>">
                                </div>
                            </div>
                            <div class="col-md-5 pr-1">
                                  <div class="form-group">
                                    <img class="item_qr_img" src="<?php echo $item_result_row['qr']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                  <p id ="item_name"><?php echo $item_result_row['name']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                  <p id ="item_dis"><?php echo $item_result_row['description']; ?></p>
                                </div>
                            </div>
                        </div>
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
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="demo/demo.js"></script>
  

</body>

</html>
