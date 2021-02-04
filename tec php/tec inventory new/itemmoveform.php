<?php require_once('connection.php'); ?>
<?php require_once('external.php'); ?>
<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
      }

 ?>
 <?php 

  $order_id="";
  $item_barcode="";
  $item_name="";
  $current_department="";
  $quantity="";
  $return_date="";
  $move_type="";
  $move_department="";
  $description="";

  if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $qrcount=0;

    if ($id!="" || $id!=NULL) {
      $statement="SELECT * FROM move where move_id= '{$id}' LIMIT 1";
      $result=mysqli_query($conn,$statement);
      if ($result) {
        if (mysqli_num_rows($result)==1) {
          while($detail = mysqli_fetch_assoc($result)) {
            $order_id = $detail['move_id'];
            $item_name = $detail['item_name'];
            $current_department = $detail['current_department'];
            $quantity = $detail['quantity'];
            $return_date = $detail['return_date'];
            $move_type = $detail['move_type'];
            $move_department = $detail['move_department'];
            $description = $detail['description'];


          }
        }else{
          echo "<script>";
             echo "can't identify move";
          echo "</script>";
        }
      }
    }else{
      header("Location:moverequestlist.php");
    }

  }else{
    header("Location:moverequestlist.php");
  }

  if (isset($_POST['add'])) {
    
   $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
   
   if ($quantity>0) {
     $barcode= mysqli_real_escape_string($conn,$_POST['qr']);
     $sql="SELECT item_id FROM item WHERE barcode='{$barcode}' LIMIT 1";
     $result = mysqli_query($conn,$sql);
     if (mysqli_num_rows($result)==1) {
      while ($detail=mysqli_fetch_assoc($result)) {
        $item_id=$detail['item_id'];
      }
        $query = "INSERT INTO temporary_moved_item(move_id ,item_id) VALUES('{$order_id}','{$item_id}')";
        $result = mysqli_query($conn,$query);
        if ($result) {
          // echo "<script>";
          //   echo "ok";
          // echo "</script>";
        }else{
          echo "<script>";
            echo "alert('not added')";
          echo "</script>";
        }
        $quantity--;
        $qrcount++;
     }else{
      echo "<script>";
        echo "alert('can not identify item')";
      echo "</script>";
     }
     
   }else{
    echo "<script>";
      echo "alert('All quentity added succesfully. Please click accept')";
    echo "</script>";
   }
  }
   

  //....................
  if (isset($_POST['accept'])) {
    $query = "UPDATE move SET quantity={$qrcount},ownerdepartment_approve=1,status='delivering' WHERE move_id='{$order_id}' LIMIT 1";
    $result = mysqli_query($conn,$query);
    if ($result) {
      header('Location:moverequestlist.php');
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
                <a class="nav-link btn-rotate" href="log out eka link karanna">
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
                <h6 class="card-title">Sending Items</h5>
                <p class="error"></p>
              </div>
              <div class="card-body">
                <form action="" method="post" action="itemmoveform.php" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Request ID </label>
                        <input type="text" class="form-control" name="order"  id="order" placeholder="order id" <?php echo "value=\"".$order_id."\"" ?> disabled="" >
                      </div>
                    </div>                
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Item Name </label>
                        <input type="text" class="form-control"  name="item_name" id="ItemName" placeholder="Item Name" <?php echo "value=\"".$item_name."\"" ?> disabled="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Current Department </label>
                        <input type="text" class="form-control"  name="current_department " id="CurrentDepartment" placeholder="Current Department" <?php echo "value=\"".$current_department."\"" ?> disabled="">
                      </div>
                    </div>
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Quantity </label>
                        <input type="number" class="form-control"  name="quantity" id="quantity" placeholder="Quantity" <?php echo "value=\"".$quantity."\"" ?>>
                      </div>
                    </div>
                    

                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      <label>Return Date</label>
                        <input type="date" name="" class="form-control" placeholder="date:" <?php echo "value=\"".$return_date."\"" ?> disabled="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pl-2">
                      <div class="form-group">
                        <label>Move Type</label>
                        <input type="text" name="move_type" class="form-control" placeholder="date:" <?php echo "value=\"".$move_type."\"" ?> disabled="">
                      </div>
                    </div>
                    <div class="col-md-7 pl-2">
                      <div class="form-group">
                        <label>Move Department</label>
                        <input type="text" name="move_department" class="form-control" placeholder="date:" <?php echo "value=\"".$move_department."\"" ?> disabled="">

                          
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Description</label>
                         <input type="text" name="description" class="form-control" placeholder="description:" <?php echo "value=\"".$description."\"" ?> disabled="">
                      </div>
                    </div>
                  </div>
                  <div class="row" id="code">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>barcode</label>
                        <input type="text" name="qr" class="form-control" placeholder="barcode:">
                        <button type="submit" name="add" class="btn btn-primary btn-round">ADD</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="accept" id="submit" class="btn btn-primary btn-round">accept</button>
                    </div>
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="reject" id="submit" class="btn btn-primary btn-round">reject</button>
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
  <script type="text/javascript">

    document.getElementById("code").innerHTML=show;
 
  </script>

</body>

</html>
