
<!DOCTYPE html>
<html lang="en">

<?php require_once('connection.php'); ?>
<?php require_once('external.php'); ?>

<?php
  $error="";
  $log_user = "staf01";/*-----sesion for uddika----*/
  $today=date("Y-m-d");
  $date_id=date("Ymd");

  $survay_info = "SELECT * FROM survey_information WHERE start_date='$today'";
  $survay_info_result = mysqli_query($conn, $survay_info) or die (mysqli_error($conn));
  $survay_count = mysqli_num_rows($survay_info_result);

  $sur_id= $date_id.($survay_count + 1);
  
  if(isset($_POST['submit1'])){
    $surver_off_01 = $conn->real_escape_string($_POST['off_name_01']);
    $surver_off_02 = $conn->real_escape_string($_POST['off_name_02']);
    $hope_date = $conn->real_escape_string($_POST['hope_dt']);

    if(!empty($surver_off_01) && !empty($surver_off_02) && !empty($hope_date)){
      if(preg_match("/^[a-zA-Z -]+$/",$surver_off_01)){
        if(preg_match("/^[a-zA-Z -]+$/",$surver_off_02)){
          $insert_data="INSERT INTO survey_information (surve_Id, start_date, survey_oficer_name_01, survey_oficer_name_02, hope_to_end, survey_user)
          VALUES ('$sur_id', '$today', '$surver_off_01', '$surver_off_02', '$hope_date', '$log_user')";
          $insert_data_result = mysqli_query($conn,$insert_data) or die (mysqli_error($conn));

        header("location:survay.php");
            }else{
              $error ="invalid officer name 01";
              }
          }else{
            $error ="invalid officer name 02";
        }
    }else{
      $error ="empty";
      }
    }
  

?>

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Survey</title>
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
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src=<?php getimage(); ?>>
          </div>
        </a>
        <a href="" class="simple-text logo-normal">
          <p id="user_name"><?php echo $_SESSION['user_name']; ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="dashboard.php">
                  <i class="nc-icon nc-badge"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li>
                <a href="survayreport.php">
                  <i class="nc-icon nc-paper"></i>
                  <p>Survey Report</p>
                </a>
              </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">New Survey Form</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="log out eka link karanna">
                  <i class="nc-icon nc-button-power"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="link setting page">
                  <i class="nc-icon nc-settings-gear-65"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h6 class="card-title">Start New Survay Fill Form and Submit</h5>
                <p class="error"> <?php echo $error; ?></p>
              </div>
              <div class="card-body">
                <form action="survayform.php" method="post" enctype = "multipart/form-data">
                  <div class="row">
                   <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Survey Id: (desabled)</label>
                        <input type="text" name="sur_id" class="form-control" disabled="" placeholder="Sur2020050103" value="<?php echo $sur_id; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Start Date (desabled)</label>
                        <input type="" name="st_date" disabled="" class="form-control" placeholder="date" value="<?php echo $today; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                    
                      <div class="form-group">
                        <label>Survey Oficer Name 01</label>
                        <input type="text" name="off_name_01" class="form-control" placeholder="name" required>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Survey Oficer Name 02</label>
                        <input type="text" name="off_name_02" class="form-control" placeholder="name" value="" required>
                     </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                      <label>Hope to End</label>
                        <input type="date" name="hope_dt" class="form-control" placeholder="date:" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit1" class="btn btn-primary btn-round">Submit</button>
                    </div>
                    <div class="update ml-auto mr-auto">
                      <a href="survay.php"> <button type="button" name="continue_survey" class="btn btn-primary btn-round">Continue surver</button></a>
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

</body>

</php>
