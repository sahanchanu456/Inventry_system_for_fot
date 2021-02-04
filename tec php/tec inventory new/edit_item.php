
<?PHP include 'connection.php' ?>
<?php
$today = date("Y-m-d");
$empty_error="";
$error="";
$error_success="";

if(isset($_GET['SendItemId'])){
  $item_id = $_GET['SendItemId'];

  $select_item = "SELECT * FROM item WHERE item_id = '$item_id' LIMIT 1";
  $select_item_result = mysqli_query($conn,$select_item) or die (mysqli_error($conn));
  $select_item_row = $select_item_result->fetch_assoc();
}

if(!empty($log_user_id) && !empty($user_position)){
  if($user_position == "student"){
    /*---------------------login admin details-----------------------*/
    $log_user = "SELECT * FROM student WHERE student_id='$log_user_id'";
    $log_user_result = mysqli_query($conn, $log_user) or die (mysqli_error($conn));
    $row = $log_user_result-> fetch_assoc();
  }else{
    $log_user = "SELECT * FROM staff WHERE staff_id='$log_user_id' AND job_position='$user_position'";
    $log_user_result = mysqli_query($conn, $log_user) or die (mysqli_error($conn));
    $row = $log_user_result-> fetch_assoc();
  }
}

if(isset($_POST['submit'])){  
    $Name = $conn->real_escape_string($_POST['itemName']);
    $Serial = $conn->real_escape_string($_POST['serial']);
    $Description = $conn->real_escape_string($_POST['desc']);
    $Model = $conn->real_escape_string( $_POST['model']);
    $Invoice = $conn->real_escape_string($_POST['invoice']);
    $Price = $conn->real_escape_string($_POST['prize']);
    $Warranty = $conn->real_escape_string($_POST['warrenty']);
    $Purchesed = $conn->real_escape_string($_POST['purchased']);
    $Inventory = $conn->real_escape_string($_POST['inventory']);
    $Current_dep = $conn->real_escape_string($_POST['current_dep']);
    $GRN = $conn->real_escape_string($_POST['grn']);
    $Owner_dep = $conn->real_escape_string($_POST['owner_dep']);
    $Category = $conn->real_escape_string($_POST['main_category']);
    $Sub_category = $conn->real_escape_string($_POST['sub_category']);
    $Depriciation = $conn->real_escape_string($_POST['depri']);
    
    $Item_id = $conn->real_escape_string($_POST['item_id']);

   

    if(!empty($Name) && !empty($Serial) && !empty($Description) && !empty($Invoice) && !empty($Price) && !empty($Warranty) && !empty($GRN)){
      if($Model != "0" && $Category != "0" && $Sub_category != "0" && $Current_dep != "0" && $Owner_dep != "0"){
        if(preg_match("/^[0-9]{3}$/",$GRN)){
          /*-----------up date item details-------------*/
          $update_name = "UPDATE item SET name='$Name', serial_number='$Serial', description='$Description', model_id='$Model', invoice_no='$Invoice', price='$Price', warranty='$Warranty', purchesed_companty='$Purchesed', inventory_page_no='$Inventory', current_department='$Current_dep', GRN_no='$GRN', owner_department='$Owner_dep', catagory='$Category', sub_catagory='$Sub_category', depreciation='$Depriciation'WHERE item_id='$Item_id'";
          $update_name_result = mysqli_query($conn, $update_name) or die (mysqli_error($conn));
            echo $Description;
               header('Location: additem.php');
                }else{
                  $error="Insert value GRN number";
                }
          }else{
              $error="Please fill";
            }
      }else{
            $empty_error="Please enter all field";
        }
      }

      if(isset($_POST['submit3']))
      {   
        $Image = $conn->real_escape_string('img/item/item'.$_FILES['user_image']['name']);
        $Item_id2 = $conn->real_escape_string($_POST['item_id2']);
        $select_item = "SELECT * FROM item WHERE item_id = '$Item_id2' LIMIT 1";
        $select_item_result = mysqli_query($conn,$select_item) or die (mysqli_error($conn));
        $select_item_row = $select_item_result->fetch_assoc();
        if(!empty($Image)){
          if(preg_match("!image!",$_FILES['user_image']['type'])){
            if(copy($_FILES['user_image']['tmp_name'], $Image)){
              $update_image = "UPDATE item SET image= '$Image' WHERE item_id='$Item_id2'";
              $update_image_result = mysqli_query($conn, $update_image) or die (mysqli_error($conn));
              header('Location: additem.php');
            }else{
              $error="Wrong image path";
            } 
          }else{
            $error="Insert value PDF type";
          } 

        }else{
          $empty_error="Please enter PDF file";
        } 
       }    

       
      if(isset($_POST['submit4']))
      {   
        $PDF = $conn->real_escape_string('pdf/pdf'.$_FILES['pdf']['name']);
        $Item_id3 = $conn->real_escape_string($_POST['item_id3']);
        $select_item = "SELECT * FROM item WHERE item_id = '$Item_id3' LIMIT 1";
        $select_item_result = mysqli_query($conn,$select_item) or die (mysqli_error($conn));
        $select_item_row = $select_item_result->fetch_assoc();
        if(!empty($PDF)){
          if(preg_match("!pdf!",$_FILES['pdf']['type'])){
            if(copy($_FILES['pdf']['tmp_name'], $PDF)){
              $update_pdf = "UPDATE item SET pdf= '$PDF' WHERE item_id='$Item_id3'";
              $update_pdf_result = mysqli_query($conn, $update_pdf) or die (mysqli_error($conn));
              header('Location: additem.php');
            }else{
              $error="Wrong PDF path";
            }
          }else{
            $error="Insert value PDF type";
          } 
        }else{
          $empty_error="Please enter all field";
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
                <a href="additem.php">
                  <i class="nc-icon nc-ruler-pencil"></i>
                  <p>Edit Items</p>
                </a>
              </li>
              <li>
                <a href="dashboard.php">
                  <i class="nc-icon nc-tv-2"></i>
                  <p>Dashboard</p>
                </a>
              </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Edit Item</a>
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
            <div class="card card-user">
              <div class="card-header">
                <p class="error">
                <?php
                  echo $empty_error,$error;
                ?>
                </p>
                <p class="msgsuc">
                <?php
                  echo $error_success;
                ?>
                </p>
              </div>
              <div class="card-body">
                <form action="edit_item.php?SendItemId=<?php echo $select_item_row['item_id']; ?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" class="form-control" placeholder="item name" value="<?php echo $select_item_row['name']; ?>" name="itemName">
                        <input type="hidden" class="form-control" placeholder="item name" value="<?php echo $select_item_row['item_id']; ?>" name="item_id">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Serial Number</label>
                        <input type="text" class="form-control"  placeholder="serial number" value="<?php echo $select_item_row['serial_number']; ?>" name="serial">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="desc" class="form-control" placeholder="description" value="<?php echo $select_item_row['description']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Model No</label>
                        <select class="form-control" name="model">
                          <option value="<?php echo $select_item_row['model_id'];?>"><?php echo $select_item_row['model_id'];?></option>
                          <?php
                              $model_no = "SELECT * FROM model"; /*---model no select box ekata data gatta---*/
                              $result = mysqli_query($conn,$model_no);
                              while($row=$result->fetch_assoc()){ /*---model no select box ekata data gatta---*/
                              $model=$row['model_id'];
                              echo '<option value="'.$model.'">'.$model.'</option>';
                            }
                          ?>
                      </select>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Invoice No</label>
                        <input type="text" name="invoice" class="form-control" placeholder="invoice No" value="<?php echo $select_item_row['invoice_no']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Price</label>
                        <input type="text" name="prize" class="form-control" placeholder="price" value="<?php echo $select_item_row['price']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Warranty Time</label>
                        <input type="date" name="warrenty" class="form-control" placeholder="warranty Time" value="<?php echo $select_item_row['warranty']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Purchesed_Company</label>
                        <input type="text" name="purchased" class="form-control" placeholder="purchesed Company" value="<?php echo $select_item_row['purchesed_companty']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Inventory Page No</label>
                        <input type="number" name="inventory" class="form-control" placeholder="inventory page no" value="<?php echo $select_item_row['inventory_page_no']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Current Department</label>
                        <select class="form-control" name="current_dep">
                          <option value="<?php echo $select_item_row['current_department'] ?>"><?php echo $select_item_row['current_department'] ?></option>
                          <?php
                              $current_department = "SELECT * FROM department"; /*---Current Department select box ekata data gatta---*/
                              $result = mysqli_query($conn,$current_department);                          
                              while($row=$result->fetch_assoc()){   /*---Current Department select box ekata data gatta---*/
                              $current_dep=$row['name'];
                              $current_dep_id=$row['department_id'];
                              echo '<option value="'.$current_dep_id.'">'.$current_dep.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>GRN</label>
                        <input type="number" name="grn" class="form-control" placeholder="grn" value="<?php echo $select_item_row['GRN_no']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub Category</label>
                        <select class="form-control" name="sub_category">
                          <option value="<?php echo $select_item_row['sub_catagory'] ?>"><?php echo $select_item_row['sub_catagory'] ?></option>
                          <?php
                          $sub_name = "SELECT * FROM subcategory"; /*---Sub Category no select box ekata data gatta---*/
                          $result = mysqli_query($conn,$sub_name);
                              while($row=$result->fetch_assoc()){ /*---Sub Category no select box ekata data gatta---*/
                              $sub_category_name=$row['name'];
                              $sub_category_id=$row['subcategory_id'];
                              echo '<option value="'.$sub_category_id.'">'.$sub_category_name.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Owner Department</label>
                        <select class="form-control" name="owner_dep">
                          <option value="<?php echo $select_item_row['owner_department'] ?>"><?php echo $select_item_row['owner_department'] ?></option>
                          <?php
                              $owner_department = "SELECT *  FROM department"; /*---Owner Department select box ekata data gatta---*/
                              $result = mysqli_query($conn,$owner_department);
                              while($row=$result->fetch_assoc()){     /*---Owner Department select box ekata data gatta---*/
                              $owner_dep=$row['name'];
                              $owner_dep_id=$row['department_id'];
                              echo '<option value="'.$owner_dep_id.'">'.$owner_dep.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="main_category">
                          <option value="<?php echo $select_item_row['catagory'] ?>"><?php echo $select_item_row['catagory'] ?></option>
                          <?php
                              $category = "SELECT * FROM category"; /*---Category no select box ekata data gatta---*/
                              $result = mysqli_query($conn,$category);
                              while($row=$result->fetch_assoc()){   /*---Category no select box ekata data gatta---*/
                              $category_name=$row['name'];
                              $category_id=$row['category_id'];
                              echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Depreciation</label>
                        <input type="number" name="depri" class="form-control" placeholder="Depreciation" value="<?php echo $select_item_row['depreciation']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Edit</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <p class="error"></p>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>PDF</label>
                      <label class="form-control">.pdf</label>
                      <input type="file" name="pdf" accept=".pdf">
                      <input type="hidden" class="form-control" placeholder="item name" value="<?php echo $select_item_row['item_id'] ?>" name="item_id3">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit4" class="btn btn-primary btn-round">Edit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <p class="error"></p>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                  <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Image</label>
                      <label class="form-control">.Jpg</label>
                        <input type="file" name="user_image" accept="image/*">
                        <input type="hidden" class="form-control" placeholder="item name" value="<?php echo $select_item_row['item_id'] ?>" name="item_id2">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit3" class="btn btn-primary btn-round">Edit</button>
                    </div>
                  </div>
                </form>
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


