<?php
  include_once 'connection.php';
  include_once 'external.php';
  
?>

<?php
  $status=1;
  $error="";
  $msgsuc="";

  if(isset($_POST["submit1"])){
        $id = $conn->real_escape_string($_POST['dept_id']);
        $name = $conn->real_escape_string($_POST['dept_name']);
        $description = $conn->real_escape_string($_POST['dept_description']);

        if(!empty($id) && !empty($name) && !empty($description) ){

            if (strlen($id)>10){
                $error="Please enter a department id with seven or less number of characters..";

            }
            else{
                  $sql="SELECT *FROM department";
                  $result= mysqli_query($conn,$sql);

                  while($row=$result->fetch_assoc()){
                      $dept=$row['department_id'];
                      if(strcmp($id, $dept)==0){
                          $status=0;
                      }

                  }

                  if($status!=0){
                      $insert="INSERT INTO `department`(`department_id`, `name`, `description`) VALUES ('$id','$name','$description')";

                      if(mysqli_query($conn,$insert)){
                         $msgsuc="Data added successfully..";
                      }

                      else{
                        $error="error..".mysqli_error($conn);
                      }
                      
                  }

                  else{
                      $error="Department id already exists..";
                  }

                  
          }

      }

      else{
          $error="Please fill all the fields..";
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
  <title>RuhTecInventory.lk/Manage Department</title>
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
            <a href="department.php">
              <i class="nc-icon nc-briefcase-24"></i>
              <p>Departments List</p>
            </a>
          </li>
           <li class="active">
            <a href="AddDepartment.php">
              <i class="nc-icon nc-simple-add"></i>
              <p>Add Department</p>
            </a>
          </li>
            
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Add New Department</a>
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
                        <label>Department Id</label>
                        <input type="text" class="form-control" placeholder="" name="dept_id">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Department Name</label>
                        <input type="text" class="form-control" placeholder="" name="dept_name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Department Discription</label>
                        <input type="text" class="form-control" placeholder="" name="dept_description">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit1" class="btn btn-primary btn-round">Add</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Department List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Department Id
                        </th>
                        <th>
                          Department Name
                        </th>
                        <th>
                          Department Discription
                        </th>
                        <th class="text-right">
                          
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                      <?php
                      $sql="SELECT *FROM department";
                      $result= mysqli_query($conn,$sql);
                      while($row=$result->fetch_assoc()){
                          echo "
                            <tr> 
                              <td>"
                                .$row['department_id'].

                                "</td>

                                <td>"
                                  .$row['name'].

                                "</td>

                                <td>"
                                  .$row['description'].

                                "</td>
                                <td>
                                      <a href=\"editDepartment.php?id=".$row['department_id']."\"><button type=\"button\" class=\"shipp_button\" name=\"main_edit\">Edit</button></a>   
                                  </td>
                                  <td class=\"text-right\">
                                      <a href=\"removeDepartment.php?id=".$row['department_id']."\" onclick=\"return confirm('Do you need to delete the selected data..')\"><button type=\"button\" class=\"shipp_button\" name=\"main_remove\">Remove</button></a>   
                                  </td> 

                            </tr>";
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
