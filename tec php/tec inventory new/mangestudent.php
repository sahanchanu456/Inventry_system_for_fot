<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  

  if (isset($_GET['did'])) {
    $did = $_GET['did'];
    $query = "DELETE FROM student WHERE student_id = '{$did}' LIMIT 1";
    $result = mysqli_query($conn,$query);
    if ($result) {
      echo "<script>";
        echo "alert('succeded...')";
      echo "</script>";
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
            <a class="navbar-brand" href="">Manage Student</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <?php navigation($conn); ?>
              <li class="nav_search">
                <form action="" method="post">
                  <div class="input-group no-border">
                    <input list="brow" value="" id="search" class="form-control" placeholder="Search..." name="search"><!---add name get text in search -->
                    <datalist id="brow">
                      <option value="Select Barcode">
                      <?php
                      /*--------------- user--------------------*/
                        $user = "SELECT * FROM staff";
                        $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                        /*--------------------user shipping table have user-------------------------*/ 
                        if(mysqli_num_rows($user_result) > 0){
                          while ($user_result_row = $user_result-> fetch_assoc()){
                            echo'<option value="'.$user_result_row['name'].'">';
                          }
                        }
                      ?>
                    </datalist>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i id="search" class="nc-icon nc-zoom-split"></i>
                      </div>
                    </div>
                  </div>
                
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
                <h4 class="card-title"> ALL Student</h4>
                <div>
                  
                    <select class="cat_select" id="year" name="year">
                      <option class="cat_select_option" value="0">All Years</option>
                     <?php 
                        $query = "SELECT distinct(year) FROM student";
                        $result = mysqli_query($conn,$query);
                        if ($result) {
                          if (mysqli_num_rows($result)>0) {
                            while ($detail = mysqli_fetch_assoc($result)) {
                              echo "<option class=\"month_select_option\" value=\"".$detail['year']."\">".$detail['year']."</option>";
                            }
                          }
                        }

                       ?>
                    </select>

                    <select class="cat_select" id="department" name="department">
                      <option class="cat_select_option" value="0">All Department</option>
                      <?php 
                        $query = "SELECT * FROM department";
                        $result = mysqli_query($conn,$query);
                        if ($result) {
                          if (mysqli_num_rows($result)>0) {
                            while ($detail = mysqli_fetch_assoc($result)) {
                              echo "<option class=\"month_select_option\" value=\"".$detail['department_id']."\">".$detail['name']."</option>";
                            }
                          }
                        }

                       ?>
                    </select>

                    <button id="clear" class="cat_ser_button">Clear</button>
                    <button id="removeall" class="cat_ser_button">Delete All Showing</button>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <p id="table"></p>    
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

      refresh();

      function refresh(){
        $.ajax({
          type:"post",
          url:"mangestudent_ajax.php",
          data:{},
          success:function(data){
            table=$.parseJSON(data);
            $('#table').html(table['table']);
          }
        });
      }
      
        
        
      $("#search").keyup(function(){
        var jsearch = $("#search").val();
        var jyear = $("#year").val();
        var jdepartment = $("#department").val();
        $.ajax({
          type:"post",
          url:"mangestudent_ajax.php",
          data:{year:jyear,department:jdepartment,search:jsearch},
          success:function(data){
            table=$.parseJSON(data);
            $('#table').html(table['table']);
          }
        });
      });

      $("#year").change(function(){
        var year = $("#year").val();
        var department = $("#department").val();
        $.ajax({
          type:"post",
          url:"mangestudent_ajax.php",
          data:{year:year,
            department:department},
          success:function(data){
            table=$.parseJSON(data);
            $('#table').html(table['table']);
          }
        });
      });

      $("#department").change(function(){
        var year = $("#year").val();
        var department = $("#department").val();
        $.ajax({
          type:"post",
          url:"mangestudent_ajax.php",
          data:{year:year,
            department:department},
          success:function(data){
            table=$.parseJSON(data);
            $('#table').html(table['table']);
          }
        });
      });
      
    });

    $("#clear").click(function(){
        $("#year").val() = '0';
        $("#department").val() = '0';
        refresh();
    });

    $("#removeall").click(function(){
      var r = confirm("Are you sure do you want to Delete All Showing Accounts????");
      if (r==true) {
        $.ajax({
          type:"post",
          url:"mangestudent_ajax.php",
          data:{removeall:"removeall"},
          success:function(data){
            result=$.parseJSON(data);
            alert(result['delete_result']);
          }
        });
      }

      refresh();
    });

    document.getElementById("ms").setAttribute("class", "active");
  </script>
</body>

</html>
