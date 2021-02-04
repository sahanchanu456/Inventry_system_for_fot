
<?php
  include_once 'connection.php';
  include_once 'external.php';
  

?>

<!--- New supplier -->

<?php


    $error="";
    $status=1;
    $msgsuc="";

    if(isset($_POST["submit1"])){

           $id = $conn->real_escape_string($_POST['sup_id']);
           $name = $conn->real_escape_string($_POST['sup_name']);
           $address = $conn->real_escape_string($_POST['sup_address']);
           $tele = $conn->real_escape_string($_POST['sup_tele']);
           $note = $conn->real_escape_string($_POST['sup_note']);
           $email = $conn->real_escape_string($_POST['sup_email']);


           // checking fields are empty
           if(!empty($id) && !empty($name) && !empty($address) && !empty($tele)  && !empty($email) ){ 
                // validating id character count
                if (strlen($id)<=20){

                    // validating phone number character count
                    if(strlen($tele)==11){

                        // validating phone number format
                         if(preg_match('/^\d{3}-\d{7}$/', $tele)){

                              $sql="SELECT *FROM supplier";
                              $result= mysqli_query($conn,$sql);


                              while($row=$result->fetch_assoc()){

                                  // validating category if to restrict duplicte entry
                                  if (!strcmp($row['supplier_id'], $id)){

                                      // set a flag variable
                                      $status=0;
                                  }

                              }

                              if($status!=0){

                                  $insert="INSERT INTO `supplier`(`supplier_id`, `name`, `address`, `telephone`, `email`, `note`) VALUES ('$id','$name','$address','$tele','$email','$note')";
                                  if(mysqli_query($conn,$insert)){
                                        $msgsuc="Data added successfully..";
                                  }
                                  else{
                                       $error="error..".mysqli_error($conn);
                                  }
                              }

                              else{
                                $error="Supplier ID is already exits..";  
                              }

                         }

                         else{
                              $error="Phone number format is incorrect..Enter in ###-####### format";
                         }
                        
                    }

                    else{
                        $error="Telephone number should contain of 11 characters.."; 
                    }
                      

                }

                else{
                    $error="Please enter a supplier id with twenty or less number of characters..";  
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
  <title>RuhTecInventory.lk/Supplier</title>
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
              <img id="user_img" src="img/teclog.png"><!-----Admin ge img eka methan size adala ne------>
          </div>
        </a>
        <a href="#Admi Acc. seting link karanna" class="simple-text logo-normal">
          <p id="user_name">Admin Name eka ganna</p>
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
          <li class="active">
            <a href="newsuplayer.php">
              <i class="nc-icon nc-simple-add"></i>
              <p>Add Supplier</p>
            </a>
          </li>
          <li>
            <a href="suplyer.php">
              <i class="nc-icon nc-ambulance"></i>
              <p>Supplier List</p>
            </a>
          </li>
            
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Add New Supplier</a>
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
                <p class="error"><?php  echo $error; ?></p>
              </div>
              <div class="card-body">
                <form action="" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Supplier Id</label>
                        <input type="text" class="form-control" placeholder="" name="sup_id">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" class="form-control" placeholder="" name="sup_name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 pr-1">
                      <div class="form-group">
                        <label>Supplier Address</label>
                        <input type="text" class="form-control" placeholder="" name="sup_address">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Supplier Tel:</label>
                        <input type="text" class="form-control" placeholder="" name="sup_tele">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 pr-1">
                      <div class="form-group">
                        <label>Note</label>
                        <input type="text" class="form-control" placeholder="" name="sup_note">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Supplier Email</label>
                        <input type="email" class="form-control" placeholder="" name="sup_email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit1" class="btn btn-primary btn-round">Submit</button>
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
                <h4 class="card-title"> Supplier List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Supplier Id
                        </th>
                        <th>
                          Supplier Name
                        </th>
                        <th>
                          Supplier Address
                        </th>
                        <th>
                          Supplier Tel:
                        </th>
                        <th>
                          Supplier Email
                        </th>
                        <th>
                          Description
                        </th>
                        <th class="text-right">
                          
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                      <?php
                            $sql="SELECT *FROM supplier";
                            $result= mysqli_query($conn,$sql);
                            while($row=$result->fetch_assoc()){
                                echo "
                                    <tr>
                                        <td>".
                                            $row['supplier_id'].
                                        "</td>

                                        <td>".
                                            $row['name'].
                                        "</td>

                                        <td>".
                                            $row['address'].
                                        "</td>

                                        <td>".
                                            $row['telephone'].
                                        "</td>

                                        <td>".
                                            $row['email'].
                                        "</td>

                                        <td>".
                                            $row['note'].
                                        "</td>

                                       

                                       <td>
                                     <a href=\"editsuplyer.php?id=".$row['supplier_id']."\"><button type=\"button\" class=\"shipp_button\" name=\"sub_edit\">Edit</button></a>   
                                    </td>
                                    <td class=\"text-right\">
                                        <a href=\"removesuplyer.php?id=".$row['supplier_id']."\" onclick=\"return confirm('Do you need to delete the selected data..')\"><button type=\"button\" class=\"shipp_button\" name=\"main_remove\">Remove</button></a>   
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

</php>
