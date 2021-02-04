
<?php require_once('connection.php'); ?>
<?php require_once('external.php'); ?>

<?php 

    if (session_status() == PHP_SESSION_NONE) {
      session_start();
      }

?>
<?php 
    $item_id = "";
    $item_name = "";
    $current_department = "";
    $request_date = "";
    $return_date = "";
    $type = "";
    $move_department = "";
    $state ="";

    $error = array();
    $lenth_error=array();


  
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Manage item & catagory</title>
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
        <a href="#Admi Acc. seting link karanna" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src=<?php getimage(); ?>>
          </div>
        </a>
        <a href="#Admi Acc. seting link karanna" class="simple-text logo-normal">
          <p id="user_name"><?php echo $_SESSION['user_name']; ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="moverequestlist.php">
              <i class="nc-icon nc-tag-content"></i>
              <p>List of Requested Move</p>
            </a>
          </li>
          <li>
            <a href="dashboard.php">
              <i class="nc-icon nc-tv-2"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="itemmoverequest.php">
              <i class="nc-icon nc-simple-add"></i>
              <p>Request to Move Item</p>
            </a>
          </li>
          <li>
            <a href="movehistory.php">
              <i class="nc-icon nc-tag-content"></i>
              <p>History of Move Item</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Item Move History</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <?php navigation($conn); ?>
              <li class="nav_search">
                <form>
                  <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." name=""><!---add name get text in search -->
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="nc-icon nc-zoom-split"></i>
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
                <h4 class="card-title"> Request Received</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          move id
                        </th>
                        <th>
                          item id
                        </th>
                        <th>
                          item name
                        </th>
                        <th>
                          current department
                        </th>
                        <!-- <th>
                          Model Name
                         </th> -->
                        <th>
                          request date
                        </th>
                        <th>
                         return date
                        </th>
                        <th>
                          type
                        </th>
                        <th>
                          move department
                        </th>
                        <th>
                          state
                        </th>
                        <th class="text-right">
                          consider
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                      <?php 
                        if (isset($_SESSION['user_id'])) {
                          $user_id=$_SESSION['user_id'];
                          $user_department=$_SESSION['department_id'];
                        }

                        $query = "SELECT * from move WHERE current_department='{$user_department}' AND status IS NULL";
                        $result = mysqli_query($conn,$query);
                        if ($result) {
                          if (mysqli_num_rows($result)>0) {
                            while ($detail = mysqli_fetch_assoc($result)) {
                              echo "<tr>";
                                echo "<td>";
                                  echo $detail['move_id'] ;
                                echo "</td>";
                                echo "<td>";
                                  echo $detail['item_id'] ;
                                echo "</td>";
                                echo  "<td>";
                                  echo $detail ['item_name'];        
                                echo "</td>";
                                echo"<td>";
                                  echo $detail ['current_department'];         
                                echo"</td>";
                                echo"<td>";
                                   echo $detail ['request_date'];     
                                echo"</td>";
                                echo"<td>";
                                  echo $detail ['return_date'];
                                echo"</td>";
                                  echo"<td>";
                                    echo $detail ['move_type'];       
                                 echo "</td>";
                                 echo "<td>";
                                    echo $detail ['move_department'];       
                                  echo "</td>";
                                  echo "<td>";
                                       echo $detail ['status'];      
                                  echo "</td>";
                                  
                                echo  "<td class=\"text-right\"S>";
                                    echo"<a href=\"itemmoveform.php?id=".$detail['move_id']." \"><button type=\"button\" class=\"shipp_button\">consider</button></a> ";
                                 echo" </td> ";
                             echo" </str>";
                             
                            }
                          }
                        }


                       ?>                         
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Request Sent</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          move id
                        </th>
                        <th>
                          item id
                        </th>
                        <th>
                          item name
                        </th>
                        <th>
                          current department
                        </th>
                        <!-- <th>
                          Model Name
                         </th> -->
                        <th>
                          request date
                        </th>
                        <th>
                         return date
                        </th>
                        <th>
                          type
                        </th>
                        <th>
                          move department
                        </th>
                        <th>
                          state
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                      <?php 
                        if (isset($_SESSION['user_id'])) {
                          $user_id=$_SESSION['user_id'];
                          $user_department=$_SESSION['department_id'];
                        }

                        $query = "SELECT * from move WHERE move_department='{$user_department}' AND status IS NULL";
                        $result = mysqli_query($conn,$query);
                        if ($result) {
                          if (mysqli_num_rows($result)>0) {
                            while ($detail = mysqli_fetch_assoc($result)) {
                              echo "<tr>";
                                echo "<td>";
                                  echo $detail['move_id'] ;
                                echo "</td>";
                                echo "<td>";
                                  echo $detail['item_id'] ;
                                echo "</td>";
                                echo  "<td>";
                                  echo $detail ['item_name'];        
                                echo "</td>";
                                echo"<td>";
                                  echo $detail ['current_department'];         
                                echo"</td>";
                                echo"<td>";
                                   echo $detail ['request_date'];     
                                echo"</td>";
                                echo"<td>";
                                  echo $detail ['return_date'];
                                echo"</td>";
                                  echo"<td>";
                                    echo $detail ['move_type'];       
                                 echo "</td>";
                                 echo "<td>";
                                    echo $detail ['move_department'];       
                                  echo "</td>";
                                  echo "<td>";
                                       echo $detail ['status'];      
                                  echo "</td>";
                             echo" </str>";
                             
                            }
                          }
                        }


                       ?>                         
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
</body>

</html>
