
<?PHP include 'connection.php' ?>

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

<!---table ekata data dAmeema saha validation--->
<?php
$today = date("Y-m-d");
$empty_error="";
$error="";
$error_success="";

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

if(isset($_POST['submit1'])){	 

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
    $Image = $conn->real_escape_string('img/item/item'.$_FILES['user_image']['name']);
    $PDF = $conn->real_escape_string('pdf/pdf'.$_FILES['pdf']['name']);

    

    if(!empty($Name) && !empty($Serial) && !empty($Description) &&   !empty($Invoice) && !empty($Price) && !empty($Warranty) && !empty($GRN) && !empty($Owner_dep) &&   !empty($Image) && !empty( $PDF) && !empty($Depriciation)){
        if($Model != "0" && $Category != "0" && $Sub_category != "0" && $Current_dep != "0" && $Owner_dep != "0"){
          if(preg_match("!image!",$_FILES['user_image']['type'])){
            if(preg_match("!pdf!",$_FILES['pdf']['type'])){
                    if(preg_match("/^[0-9]{3}$/",$GRN)){
                      if(copy($_FILES['user_image']['tmp_name'], $Image)){
                        if(copy($_FILES['pdf']['tmp_name'], $PDF)){        

                          require_once 'phpqrcode/qrlib.php';
                          $text = $Category."/".$Sub_category."/".$Model."/".$Current_dep."/".$Name;
                          $name = $Category."_".$Sub_category."_".$Model."_".$Current_dep."_".$Name;
                          $path = 'img/qr/';
                          $file = $path.$name.".png";

                          QRcode::png($text,$file,'L',10);


                          $insert_value = "INSERT INTO item (name, barcode, serial_number, description, model_id, invoice_no, price, warranty, date, purchesed_companty, inventory_page_no, current_department, GRN_no, move_sate, owner_department, current_state, catagory, image, sub_catagory, pdf, qr, add_user, depreciation) 
                          VALUES ('$Name', '$text', '$Serial', '$Description', '$Model', '$Invoice', '$Price', '$Warranty', '$today', '$Purchesed', '$Inventory', '$Current_dep', '$GRN', 'NO', '$Owner_dep', 'GOOD' , '$Category', '$Image', '$Sub_category', '$PDF', '$file', '$log_user_id', '$Depriciation')";
                          $insert_value_result = mysqli_query($conn,$insert_value) or die (mysqli_error($conn));
                          $sesion_error = " Welcome !<b> Faculty of Technology Inventry System</b>";
                          $error_success="<script> demo.showNotification('top','center','".$sesion_error."', 'success', 'nc-icon nc-bank'); </script>";
                        }else{
                          $error="Wrong PDF path"; 
                        } 
                      }else{
                        $error="Wrong image path";
                      } 
                    }else{
                      $error="Insert value GRN number";
                    }
                  }else{
                    $error="Insert value PDF type";
                  } 
               }else{
              $error="Insert value image type";
            } 
          }else{
            $error="Please fill";
        }
      }else{
        $empty_error="Please enter all field";
        }
      }
  
?>

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
            <a href="" class="simple-text logo-normal">
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
                <a href="additem.html">
                  <i class="nc-icon nc-simple-add"></i>
                  <p>Add Items</p>
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
            <a class="navbar-brand" href="">Add New Item</a>
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" class="form-control" placeholder="item name" value="" name="itemName">
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Serial Number</label>
                        <input type="text" class="form-control"  placeholder="serial number" value="" name="serial">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="desc" class="form-control" placeholder="description" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Model No</label>
                        <select class="form-control" name="model">
                          <option value="0">No Select</option>
                          <?php
                              $model_no = "SELECT * FROM model"; /*---model no select box ekata data gatta---*/
                              $result = mysqli_query($conn,$model_no);
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
                        <input type="text" name="invoice" class="form-control" placeholder="invoice No" value="">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Price</label>
                        <input type="text" name="prize" class="form-control" placeholder="price" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Warranty Time</label>
                        <input type="date" name="warrenty" class="form-control" placeholder="warranty Time" value="">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Purchased_Company</label>
                        <input type="text" name="purchased" class="form-control" placeholder="Purchased Company" value="">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Inventory Page No</label>
                        <input type="number" name="inventory" class="form-control" placeholder="inventory page no" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Current Department</label>
                        <select class="form-control" name="current_dep">
                          <option value="0">No Select</option>
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
                        <input type="number" name="grn" class="form-control" placeholder="grn" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub Category</label>
                        <select class="form-control" name="sub_category">
                          <option value="0">No Select</option>
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
                          <option value="">No Select</option>
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
                          <option value="">No Select</option>
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
                        <input type="number" name="depri" class="form-control" placeholder="Depreciation" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Image</label>
                      <label class="form-control">.Jpg</label>
                        <input type="file" name="user_image" accept="image/*">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>PDF</label>
                      <label class="form-control">.pdf</label>
                      <input type="file" name="pdf" accept=".pdf">
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
                <h4 class="card-title"> ALL Inventry Items</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Serial Number
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                          Model No
                        </th>
                        <th>
                          Invoice No
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Warranty Time
                        </th>
                        <th>
                          Purchased Company	
                        </th>
                        <th>
                          Inventory Page No
                        </th>
                        <th>
                          Current Department
                        </th>
                        <th>
                          GRN
                        </th>
                        <th>
                          Owner Department
                        </th>
                        <th>
                          Category
                        </th>
                        <th>
                          Sub Category
                        </th>
                        <th>
                          Depreciation
                        </th>
                        <th>
                          Image
                        </th>
                        <th class="text-right">
                          PDF
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                    <?php /* show data in table */
                $item_id = '';
                $item = "SELECT * FROM item";
                $item_result = mysqli_query($conn, $item);
                if(mysqli_num_rows($item_result)>0){
                  while($item_row=mysqli_fetch_assoc($item_result)){
                    $item_id = $item_row['item_id'];
                  echo
                    '
                      <tr>
                        <td>
                          '.$item_row['name'].'          
                        </td>
                        <td>
                          '.$item_row['serial_number'].'        
                        </td>
                        <td>
                          '.$item_row['description'].'         
                        </td>
                        <td>
                          '.$item_row['model_id'].'      
                        </td>
                        <td>
                          '.$item_row['invoice_no'].' 
                        </td>
                        <td>
                          '.$item_row['price'].'        
                        </td>
                        <td>
                          '.$item_row['warranty'].'        
                        </td>
                        <td>
                          '.$item_row['purchesed_companty'].'       
                        </td>
                        <td>
                          '.$item_row['inventory_page_no'].'      
                        </td>
                        <td>
                          '.$item_row['current_department'].'        
                        </td>
                        <td>
                          '.$item_row['GRN_no'].'     
                        </td>
                        <td>
                          '.$item_row['owner_department'].'       
                        </td>
                        <td>
                          '.$item_row['catagory'].'       
                        </td>
                        <td>
                        '.$item_row['sub_catagory'].'       
                        </td>
                        <td>
                        '.$item_row['depreciation'].'       
                        </td>
                        <td>
                          '.$item_row['image'].'      
                        </td>
                        <td>
                          '.$item_row['pdf'].'        
                        </td>
                        <td>
                            <a href="edit_item.php?SendItemId='.$item_id.'"><button type="button" class="shipp_button">Edit</button></a>   
                        </td>
                        <td class="text-right">
                        <a href="#" data-itemid='.$item_id.' class="item_remove"><button type="button" id="myBtn" class="shipp_button">Remove</button></a>    
                        </td>
                      </tr> 
                      ';
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
  <div class="modal fade custom_search_pop" id="itemeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog" id="model_d" role="document">
        <div class="model_body">
        
        </div>
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
   <script type='text/javascript'>
        // load item details
         $(document).ready(function(){

            $('.item_remove').click(function(){
   
                var itemid = $(this).data('itemid');
                // pass item id
                $.ajax({
                    url: 'exphp/itemremocom.php',
                    type: 'post',
                    data: {itemid: itemid},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>

</body>


