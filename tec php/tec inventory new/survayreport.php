<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 

  if (!isset($_SESSION['job_position'])) {
    header('Location:index.php');
  }else{
    $job_position = $_SESSION['job_position'];
  }

  if ($job_position=="Admin" || $job_position=="AB" || $job_position=="Survayperson") {

  }else{
    header('Location:dashboard.php');
  }


 ?>

<!DOCTYPE html>
<html lang="en">

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
          <p id="user_name"><?php echo $_SESSION['user_name'] ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="dashboard.php">
                  <i class="nc-icon nc-badge"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li  class="active">
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
            <a class="navbar-brand" href="">Survey Report</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="index.php">
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
          <div class="col-md-12">
            <div class="card card-plain">

              <div class="card-header">
                <h4 class="card-title">Select wanted list</h4>
                <div>
                  <form action="survayreport.php" method="post" >
                    <select class="cat_select" id="select" name="select">
                      <option class="cat_select_option" value="AII">All Inventory Item</option>
                      <option class="cat_select_option" value="NSI">New Survey Items</option>
                      <option class="cat_select_option" value="MI">Missing Items</option>
                      <option class="cat_select_option" value="DI">Destroyed Items</option>
                      <option class="cat_select_option" value="SI">Sold Item</option>
                      <option class="cat_select_option" value="WI">Warranty Item</option>
                      <option class="cat_select_option" value="RI">Repair Item</option>
                      <option class="cat_select_option" value="SW">Ship to wellamadama</option>
                    </select>
                  </form>
                </div>
              </div>

              <div class="card-header">
                <h4 class="card-title"><p id="table_title"></h4>
                <div>
                  <button type="button" id="pdf" class="cat_ser_button">PDF</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary" id="table_head">
                    </thead>
                    <tbody id="table_body">                        
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
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js" type="text/javascript"></script>
  <script src="demo/demo.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $.ajax({
        type:"post",
        url:"survayreporttable.php",
        data:{selected:"AII"},
        success:function(data){
          //alert(data);
          table_data=$.parseJSON(data);
          $('#table_title').html(table_data['title']);
          $('#table_head').html(table_data['head']);
          $('#table_body').html(table_data['body']);
        }
      });

      $("#select").change(function(){
        var select = $("#select").val();
        //alert(select);
        $.ajax({
          type:"post",
          url:"survayreporttable.php",
          data:{selected:select},
          success:function(data){
            //alert(data);
            table_data=$.parseJSON(data);
            $('#table_title').html(table_data['title']);
            $('#table_head').html(table_data['head']);
            $('#table_body').html(table_data['body']);
          }
        });
      });

      $("#pdf").click(function(){
        var select = $("#select").val();
        
        window.open("survayreportpdf.php?selected="+select);

        // $.ajax({
        //   type:"post",
        //   url:"survayreportpdf.php",
        //   data:{selected:select},
        //   success:function(data){
        //     alert(data);
        //   }
        // });
      });
    });
  </script>

</body>

</php>
