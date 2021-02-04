<?php require_once('connection.php'); ?>
<?php require_once('external.php'); ?>
<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
      }

 ?>
 <?php 

    $user = "admin";

    $item_name = "";
    $return_date = "";
    $type = "";
    $which_department = "";
    $description = "";
    $user_department = NULL;

    $error = array();
    $lenth_error=array();

    if (isset($_SESSION['job_possession'])) {
      $job_possession = $_SESSION['job_possession'];
      if ($job_possession!='to') {
        header('Location:dashboard.php');
      }
    }else{
      //header('Location:dashboard.php');
      $job_possession = "admin";
    }


    if (isset($_POST['submit'])) {
      $requre_fild = array('move_name','description','quantity');
      $error = array_merge($error,check_empty($requre_fild));

      $max_length = array('move_name'=>150,'description'=>700);
      $lenth_error = array_merge($lenth_error,check_length($max_length));

      $item_name = mysqli_real_escape_string($conn,$_POST['move_name']);
      $return_date = mysqli_real_escape_string($conn,$_POST['return_date']);
      $type = mysqli_real_escape_string($conn,$_POST['type']);
      $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
      $which_department = mysqli_real_escape_string($conn,$_POST['which_department']);
      $description = mysqli_real_escape_string($conn,$_POST['description']);

      if ($quantity<1) {
        $error[]="Please enter valid quantity";
      }

      $get_department = "SELECT department_id FROM staff WHERE staff_id=\"{$_SESSION['user_id']}\" LIMIT 1";
      $result = mysqli_query($conn,$get_department);
      if ($result) {
        while ($detail = mysqli_fetch_assoc($result)) {
          $user_department = $detail['department_id'];
        }

        if (mysqli_num_rows($result)==1) {
          if (empty($error) && empty($lenth_error)) {
            $qury = "INSERT INTO move(item_name,current_department,quantity,return_date,move_type,move_department,description)value('{$item_name}','{$which_department}','{$quantity}','{$return_date}','{$type}','{$user_department}','{$description}')";
            $result = mysqli_query($conn,$qury);
            if ($result) {
              echo "<script>";
                echo "alert('request sent...')";
              echo "</script>";
            }else{
              echo "<script>";
                echo "alert('request not sent!!!')";
              echo "</script>";
            }
          }
        }
      }else{

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
  <title>Ruh TecInventory.lk/Manage Item & Catagory</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <!--------font & Awesome icon link down----------->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="demo/demo.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#ItemName").keypress(function(){
        var ItemName = $("#ItemName").val();
        var arr = new Array();
        $.ajax({
          type:"post",
          url:"getitemname.php",
          data:{name:ItemName},
          success:function(data){
              document.getElementById("suggesetion").innerHTML=data;
          }

        });
      });

      $("#ItemName").blur(function(){

        document.getElementById("suggesetion").innerHTML="";
        document.getElementById("suggesetion").style.border="0px";

       
      });

    });

  </script>
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
          <li id="dashboard">
            <a href="dashboard.php">
              <i class="nc-icon nc-tv-2"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active">
            <a href="moveitem.php">
              <i class="nc-icon nc-send"></i>
              <p>Move Item</p>
            </a>
          </li>
        </ul>
      </div>
      
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Move Item Form</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="index.php">
                  <i class="nc-icon nc-button-power"></i>
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
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h6 class="card-title">Requesting Item </h5>
                <p class="error"><?php print_error($error,$lenth_error) ?></p>
              </div>
              <div class="card-body">
                <form action="" method="post" action="itemmoverequest.php" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Item Name </label>
                        <input list="brow" class="form-control" placeholder="name" name="move_name">
                          <datalist id="brow">
                            <option value="Select Item">
                            <?php
                            /*--------------- item--------------------*/
                              $item = "SELECT * FROM item";
                              $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
                              /*--------------------item shipping table have item-------------------------*/ 
                              if(mysqli_num_rows($item_result) > 0){
                                while ($item_result_row = $item_result-> fetch_assoc()){
                                  echo'<option value="'.$item_result_row['name'].'">';
                                }
                              }
                          ?>
                        </datalist>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                      <label>Return Date</label>
                        <input type="date" name="return_date" class="form-control" placeholder="date:" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 pl-2">
                      <div class="form-group">
                        <label>Move Type</label>
                        <select class="form-control" name="type">
                            <option value="Permanent">Permanent</option>
                            <option value="Temporary">Temporary</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3 pl-2">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity:" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-2">
                      <div class="form-group">
                        <label>From Which Department</label>
                        <select class="form-control" name="which_department">
                          <option value="">Not Selected</option>
                          <?php 
                            $query = "SELECT * FROM department";
                            $result = mysqli_query($conn,$query);
                            if ($result) {
                              while ($detail = mysqli_fetch_assoc($result)) {
                                if ($detail['department_id']!=$_SESSION['department_id']) {
                                  echo "<option value=\"".$detail['department_id']."\">".$detail['name']."</option>";
                                }
                                
                              }
                            }else{
                              echo "<option>error loading</option>";
                            }

                           ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name ="description" class="form-control" placeholder="Description" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" onclick=backupscript.php name="submit" id="submit" class="btn btn-primary btn-round">Submit</button>
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

</html>
