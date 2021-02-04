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
  }

 ?>

<?php 

  if (isset($_GET['did'])) {
    $did = mysqli_real_escape_string($conn,$_GET['did']);

    $query = "DELETE FROM staff WHERE staff_id = '{$did}' LIMIT 1";
    $result = mysqli_query($conn,$query);
    if ($result) {
      echo '<script type="text/javascript">'; 
      echo 'alert("Update is succed...");'; 
      echo 'window.location.href = "removeuserlist.php";';
      echo '</script>';
    }
  }

  $table = "";
    $table .= "<tr>";
      $table .= "<th>Id</th><th>Name</th><th>Account type</th><th>Department</th><th>Tel.No:</th><th>Email</th><th>Registered_Date</th>";
      if ($job_position =='admin' || $job_position == 'Admin') {
       $table .= "<th></th><th></th><th class=\"text-right\"></th>"; 
      }
    $table .= "</tr>";
  $table .= "</thead>";
  $table .= "<tbody id=\"tabel_body\">";
    $get_user_list = "SELECT * FROM staff WHERE state='Retire'";


    if (isset($_POST['searchbtn'])) {
      $search = mysqli_real_escape_string($conn,$_POST['search']);
      $get_user_list .= " AND (staff_id LIKE'%".$search."%' or name LIKE '%".$search."%' or telephone LIKE '%".$search."%' or email LIKE '%".$search."%' or registered_date LIKE '%".$search."%' or job_position LIKE '%".$search."%' or department_id LIKE '%".$search."%')";
    }

    $result = mysqli_query($conn,$get_user_list);
    if ($result) {
      while ($detail = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
          $table .= "<td>".$detail['staff_id']."</td><td>".$detail['name']."</td><td>".$detail['job_position']."</td><td>".$detail['department_id']."</td><td>".$detail['telephone']."</td><td>".$detail['email']."</td><td>".$detail['registered_date']."</td>";
            if ($job_position =='admin' || $job_position == 'Admin') {
             $table .= "<td><a href=\"edituser.php?id=".$detail['staff_id']."\"><button type=\"button\" class=\"shipp_button\">Edit</button></a></td><td><a href=\"removeuserlist.php?did=".$detail['staff_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to Delete')\" class=\"shipp_button\">Delete</button></a></td><td><a href=\"passreset.php?id=".$detail['staff_id']."\"><button type=\"button\" onclick=\"return confirm('Are you sure do you want to reset password')\" class=\"shipp_button\">Pass.reset</button></a></td>"; 
            }
        $table .= "</tr>";
        
      }
    }else{

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
            <a class="navbar-brand" href="">Remove User List</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <?php navigation($conn); ?>
              <li class="nav_search">
                <form action="removeuserlist.php" method="post">
                  <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." name="search"><!---add name get text in search -->
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <button type="submit" name="searchbtn" class="nc-icon nc-zoom-split"></button>
                      </div>
                    </div>
                  </div>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Remove User</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <form action="removeuserlist.php" method="post">
                        <?php 
                          echo $table;
                        ?>
                      </form>                     
                    </tbody>
                  </table>
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
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  
  <script type="text/javascript">
    document.getElementById("rul").setAttribute("class", "active");
  </script>

</body>

</html>
