<?php include 'conn/conection.php' ?>
<?php
/*---additem.php pass data---*/ 

/*---table ekata data dAmeema saha validation---*/
$today = date("Y-m-d");
$user = "admin";

if(isset($_GET['SendItemId'])){
  $item_id = $_GET['SendItemId'];

  $select_item = "SELECT * FROM item WHERE item_id = '$item_id' LIMIT 1";
  $select_item_result = mysqli_query($con,$select_item) or die (mysqli_error($con));
  $select_item_row = $select_item_result->fetch_assoc();
}

if(isset($_POST['submit2']))
  {  
    $Name = $con->real_escape_string($_POST['itemName']);
    $Serial = $con->real_escape_string($_POST['serial']);
    $Description = $con->real_escape_string($_POST['desc']);
    $Model = $con->real_escape_string( $_POST['model']);
    $Invoice = $con->real_escape_string($_POST['invoice']);
    $Price = $con->real_escape_string($_POST['prize']);
    $Warranty = $con->real_escape_string($_POST['warrenty']);
    $Purchesed = $con->real_escape_string($_POST['purchased']);
    $Inventory = $con->real_escape_string($_POST['inventory']);
    $Current_dep = $con->real_escape_string($_POST['current_dep']);
    $GRN = $con->real_escape_string($_POST['grn']);
    $Owner_dep = $con->real_escape_string($_POST['owner_dep']);
    $Category = $con->real_escape_string($_POST['main_category']);
    $Sub_category = $con->real_escape_string($_POST['sub_category']);
    $Depriciation = $con->real_escape_string($_POST['depri']);
    
    $Item_id = $con->real_escape_string($_POST['item_id']);

    $select_item = "SELECT * FROM item WHERE item_id = '$Item_id' LIMIT 1";
  $select_item_result = mysqli_query($con,$select_item) or die (mysqli_error($con));
  $select_item_row = $select_item_result->fetch_assoc();
    

    if(!empty($Name) && !empty($Serial) && !empty($Description) &&   !empty($Invoice) && !empty($Price) && !empty($Warranty) && !empty($GRN) && !empty($Owner_dep) && !empty($Depriciation)){
        if($Model != "0" && $Category != "0" && $Sub_category != "0" && $Current_dep != "0" && $Owner_dep != "0"){
            if(preg_match("/^[0-9]{1}$/",$GRN)){
                      /*-----------up date item details-------------*/
                  $update_name = "UPDATE item SET name='$Name', serial_number='$Serial', description='$Description', model_id='$Model', invoice_no='$Invoice', price='$Price', warranty='$Warranty', purchesed_companty='$Purchesed', inventory_page_no='$Inventory', current_department='$Current_dep', GRN_no='$GRN', owner_department='$Owner_dep', catagory='$Category', sub_catagory='$Sub_category', description='$Depriciation'WHERE item_id='$Item_id'";
                  $update_name_result = mysqli_query($con, $update_name) or die (mysqli_error($con));
                  header('Location: additem.php');
                }else{
                  echo"a";
                }
            
            }else{
            echo"d";
            }
      }else{
          echo"e";
        }
      }else{
        echo"e";
      }

      if(isset($_POST['submit3']))
      {   
        $Image = $con->real_escape_string('img/item/item'.$_FILES['user_image']['name']);
        $Item_id2 = $con->real_escape_string($_POST['item_id2']);
        $select_item = "SELECT * FROM item WHERE item_id = '$Item_id2' LIMIT 1";
        $select_item_result = mysqli_query($con,$select_item) or die (mysqli_error($con));
        $select_item_row = $select_item_result->fetch_assoc();
        if(!empty($Image)){
          if(preg_match("!image!",$_FILES['user_image']['type'])){
            if(copy($_FILES['user_image']['tmp_name'], $Image)){
              $update_image = "UPDATE item SET image= '$Image' WHERE item_id='$Item_id2'";
              $update_image_result = mysqli_query($con, $update_image) or die (mysqli_error($con));
              header('Location: additem.php');
            }else{
            echo 'b';
            } 
          }else{
            echo 'b';
          } 

        }else{
          echo 'a';
        } 
       }    

       
      if(isset($_POST['submit4']))
      {   
        $PDF = $con->real_escape_string('pdf/pdf'.$_FILES['pdf']['name']);
        $Item_id3 = $con->real_escape_string($_POST['item_id3']);
        $select_item = "SELECT * FROM item WHERE item_id = '$Item_id3' LIMIT 1";
        $select_item_result = mysqli_query($con,$select_item) or die (mysqli_error($con));
        $select_item_row = $select_item_result->fetch_assoc();
        if(!empty($PDF)){
          if(copy($_FILES['pdf']['tmp_name'], $PDF)){
              $update_pdf = "UPDATE item SET pdf= '$PDF' WHERE item_id='$Item_id3'";
              $update_pdf_result = mysqli_query($con, $update_pdf) or die (mysqli_error($con));
              header('Location: additem.php');
          }else{
            echo 'b';
          }
        }else{
          echo 'a';
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
        <a href="#Admi Acc. seting link karanna" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src="img/teclog.png"> <!-----Admin ge img eka methan size adala ne------>
          </div>
        </a>
        <a href="#Admi Acc. seting link karanna" class="simple-text logo-normal">
          <p id="user_name">Admin Name eka ganna</p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="additem.html">
                  <i class="nc-icon nc-ruler-pencil"></i>
                  <p>Edit Items</p>
                </a>
              </li>
              <li>
                <a href="dashboard.html">
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
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <p class="error"></p>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" class="form-control" placeholder="item name" value="<?php echo $select_item_row['name'] ?>" name="itemName">
                        <input type="hidden" class="form-control" placeholder="item name" value="<?php echo $select_item_row['item_id'] ?>" name="item_id">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Serial Number</label>
                        <input type="text" class="form-control"  placeholder="serial number" value="<?php echo $select_item_row['serial_number'] ?>" name="serial">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="desc" class="form-control" placeholder="description" value="<?php echo $select_item_row['description'] ?>">
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
                              $model_no = "SELECT DISTINCT model_id FROM model"; /*---model no select box ekata data gatta---*/
                              $result = mysqli_query($con,$model_no);
                              while($row=$result->fetch_assoc()){ /*---model no select box ekata data gatta---*/
                              $model=$row['model_id'];
                              echo '<option value="'.$model.'">'.$model.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Invoice No</label>
                        <input type="text" name="invoice" class="form-control" placeholder="invoice No" value="<?php echo $select_item_row['invoice_no'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Price</label>
                        <input type="text" name="prize" class="form-control" placeholder="price" value="<?php echo $select_item_row['price'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Warranty Time</label>
                        <input type="date" name="warrenty" class="form-control" placeholder="warranty Time" value="<?php echo $select_item_row['warranty'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Purchesed_Company</label>
                        <input type="text" name="purchased" class="form-control" placeholder="purchesed Company" value="<?php echo $select_item_row['purchesed_companty'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Inventory Page No</label>
                        <input type="number" name="inventory" class="form-control" placeholder="inventory page no" value="<?php echo $select_item_row['inventory_page_no'] ?>">
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
                              $current_department = "SELECT DISTINCT current_department FROM move"; /*---Current Department select box ekata data gatta---*/
                              $result = mysqli_query($con,$current_department);                          
                              while($row=$result->fetch_assoc()){   /*---Current Department select box ekata data gatta---*/
                              $current_dep=$row['current_department'];
                              echo '<option value="'.$current_dep.'">'.$current_dep.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>GRN</label>
                        <input type="number" name="grn" class="form-control" placeholder="grn" value="<?php echo $select_item_row['GRN_no'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub Category</label>
                        <select class="form-control" name="sub_category">
                          <option value="<?php echo $select_item_row['sub_catagory'] ?>"><?php echo $select_item_row['sub_catagory'] ?></option>
                          <?php
                          $sub_name = "SELECT * FROM subcategory"; /*---Sub Category no select box ekata data gatta---*/
                          $result = mysqli_query($con,$sub_name);
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
                              $owner_department = "SELECT DISTINCT owner_department FROM move"; /*---Owner Department select box ekata data gatta---*/
                             $result = mysqli_query($con,$owner_department);
                              while($row=$result->fetch_assoc()){     /*---Owner Department select box ekata data gatta---*/
                              $owner_dep=$row['owner_department'];
                              echo '<option value="'.$owner_dep.'">'.$owner_dep.'</option>';
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
                              $category = "SELECT DISTINCT name FROM category"; /*---Category no select box ekata data gatta---*/
                              $result = mysqli_query($con,$category);
                              while($row=$result->fetch_assoc()){   /*---Category no select box ekata data gatta---*/
                              $category_name=$row['name'];
                              echo '<option value="'.$category_name.'">'.$category_name.'</option>';
                            }
                          ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Depreciation</label>
                        <input type="number" name="depri" class="form-control" placeholder="Depreciation" value="<?php echo $select_item_row['depreciation'] ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit2" class="btn btn-primary btn-round">Edit</button>
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


