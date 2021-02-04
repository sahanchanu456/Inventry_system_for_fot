
<?php 
  include_once 'connection.php'; 
  include_once 'external.php'; 

?>


<?php 

    $msgsuc="";
    $error="";
    $id='';
    $name = '';
    $description = '';
    $status=1;

  if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM category WHERE category_id='{$id}' LIMIT 1";
        $result = mysqli_query($conn,$query);

        if ($result) {
          while ($detail = mysqli_fetch_assoc($result)) {
            $name = $detail['name'];
            $description = $detail['description'];
          }


        }
        if(isset($_POST['edit'])){
            
            $name = $conn->real_escape_string($_POST['name']);
            $description = $conn->real_escape_string($_POST['description']);

            if(!empty($name) && !empty($description) ){
              $update="UPDATE `category` SET `name`='{$name}',`description`='{$description}' WHERE category_id='{$id}' ";
              if(mysqli_query($conn,$update)){
                    $msgsuc="Data updated successfully..";
                    header('Location:ViewMainCategory.php');
              }
              else{
                    $error="error..".mysqli_error($conn);

              }

            }
            else{
              $error="Please fill all the fields..";
            }


        }
  }

  else{
    header('Location:ViewMainCategory.php');
  }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Manage Item & Catagory</title>
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
           <li>
                <a href="dashboard.php">
                  <i class="nc-icon nc-tv-2"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            <li>
            <a href="ViewMainCategory.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Main Category List</p>
            </a>
          </li>
          <li class="active">
            <a href="#">
              <i class="nc-icon nc-ruler-pencil"></i>
              <p>Edit Main Catagory</p>
            </a>
          </li>
           
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Catagory Edit</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
               <a class="nav-link btn-rotate" href="index.php">
                     <i class="nc-icon nc-button-power"></i>
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
                <h6 class="card-title"></h5>
                <p class="msgsuc"><?php  echo $msgsuc;?> </p>
                <p class="error"><?php  echo $error;?></p>
              </div>
              <div class="card-body">
                <form action="" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Catagory Id (disable)</label>
                        <input type="text" class="form-control" disabled="" placeholder="" name="id" <?php echo 'value="'.$id.'"';?>>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Catagory Name</label>
                        <input type="text" class="form-control" placeholder="" name="name" <?php echo 'value="'.$name.'"';?>>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Catagory Discription</label>
                        <input type="text" class="form-control" placeholder="" name="description" <?php echo 'value="'.$description.'"';?>>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="edit" class="btn btn-primary btn-round" onclick="return confirm('Do you need to update the data..')">Edit</button>
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
