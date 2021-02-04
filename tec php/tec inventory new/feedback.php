
<?PHP include 'connection.php' ?>
<?PHP

  $error ="";
  $error_suc ="";
  $error_emty ="";
  $numcount ="0";
  $date_today=date("Y-m-d");


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

  if($user_position == "Admin"){
    /*--------------- feedback--------------------*/
    $feedback = "SELECT * FROM feedback";
    $feedback_result = mysqli_query($conn, $feedback) or die (mysqli_error($conn));
  }else{
    $feedback = "SELECT * FROM feedback WHERE feedback_user_id='$log_user_id'";
    $feedback_result = mysqli_query($conn, $feedback) or die (mysqli_error($conn));
  }


  if(isset($_POST["submit"])){
    /*----------get form data------------------------*/
    $barcode = $conn->real_escape_string($_POST['barcode']);
    $feed_title = $conn->real_escape_string($_POST['feedtital']);
    $feed_feed = $conn->real_escape_string($_POST['feedfeed']);
    
    /*----------form validation------------------------*/
    if(!empty($barcode) && !empty($feed_title) && !empty($feed_feed)){
      if($barcode != "Select Barcode"){
        
        $item = "SELECT * FROM item WHERE barcode = '$barcode'";
        $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
        $item_row = $item_result-> fetch_assoc();
        $item_id = $item_row['item_id'];

        $insert_feed = "INSERT INTO feedback (feedback_item_id, feedback_user_id, feedback_user_state, feedback_feed, feedback_date, feedback_tital)
        VALUES('$item_id', '$log_user_id', '$user_position', '$feed_feed', '$date_today', '$feed_title')";
        $insert_feed_result = mysqli_query($conn, $insert_feed) or die (mysqli_error($conn)); 

        $error_suc = "Succses Full! <b> Add New Feedback</b>";
         
        //header("location: feedback.php");    
      }else{
        $error ="Please Enter Valid barcode";
      }           
    }else{
      $error_emty ="Filed Emty, All filed Fill And Submit";
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
      <?PHP
          if(!empty($log_user_id) && !empty($user_position)){
            echo'<a href="userprofile.php" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img id="user_img" src="';
                if($row['image'] == NULL || $row['image'] == ""){
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
            <a href="feedback.php">
              <i class="nc-icon nc-chat-33"></i>
              <p>Feedback</p>
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
            <a class="navbar-brand" href="">Feedback</a>
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
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Feedback List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          
                        </th>
                        <th>
                          BarCode
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Mdel
                        </th>
                        <th>
                          Item Discription
                        </th>
                        <th>
                          Feedback Date
                        </th>
                        <th>
                          Feedback User Id
                        </th>
                        <th>
                          Feedback User Name
                        </th>
                        <th>
                          Feedback User State
                        </th>
                        <th>
                          Feedback Title
                        </th>
                        <th class="text-right">
                        
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                    <?PHP
                      /*--------------------item table-------------------------*/ 
                        if(mysqli_num_rows($feedback_result) > 0){
                          /*-------------diaplay item ---------------*/
                          while ($feedback_row = $feedback_result-> fetch_assoc()){
                            $numcount = $numcount + 1;
                            $feedback_id = $feedback_row['feedback_id'];
                            $feedback_item_id = $feedback_row['feedback_item_id'];
                            $feedback_user_id = $feedback_row['feedback_user_id'];
                            $feedback_user_state = $feedback_row['feedback_user_state'];
                            /*------item details for feed-----*/
                            $item = "SELECT * FROM item WHERE item_id = '$feedback_item_id'";
                            $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
                            $item_row = $item_result-> fetch_assoc();
                            /*----user details------*/
                            if($feedback_user_state == "student"){
                              $user = "SELECT * FROM student WHERE student_id='$feedback_user_id'";
                              $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                              $user_row = $user_result-> fetch_assoc();
                            }else{
                              $user = "SELECT * FROM staff WHERE staff_id='$feedback_user_id' AND job_position='$feedback_user_state'";
                              $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                              $user_row = $user_result-> fetch_assoc();
                            }
                            echo'<tr>
                                <td>
                                  '.$numcount.'          
                                </td>
                                <td>
                                  '.$item_row['barcode'].'       
                                </td>
                                <td>
                                '.$item_row['name'].'      
                                </td>
                                <td>
                                '.$item_row['model_id'].'     
                                </td>
                                <td>
                                '.$item_row['description'].'
                                </td>
                                <td>
                                '.$feedback_row['feedback_date'].'      
                                </td>
                                <td>
                                '.$feedback_row['feedback_user_id'].'      
                                </td>
                                <td>
                                '.$user_row['name'].'      
                                </td>
                                <td>
                                '.$feedback_row['feedback_user_state'].'      
                                </td>
                                <td class="no_exper_table">
                                '.$feedback_row['feedback_tital'].'      
                                </td>
                                <td class="text-right">
                                   <a href="#"  data-feedid='.$feedback_id.' class="feed_more"><button type="button" id="myBtn" class="shipp_button"> More..</button></a>     
                                </td>
                                <td class="text-right">
                                  <a href="#" data-feedid='.$feedback_id.' class="feed_remove"><button type="button" class="shipp_button">Remove</button></a>       
                                </td>
                              </tr>'; 
                          }                
                        }else{
                          $error = "Table Emty";
                        }
                      ?>                
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h6 class="card-title">Add Feedback</h5>
                <p class="msgsuc"><?php echo $error_suc; ?></p>
                <p class="error"><?php echo $error_emty, $error; ?></p>
              </div>
              <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype = "multipart/form-data">
                  <div class="row">
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                        <label>Feedback Item Barcode</label>
                        <input list="brow" class="form-control" placeholder="Barcode" name="barcode">
                          <datalist id="brow">
                            <option value="Select Barcode">
                            <?php
                            /*--------------- item--------------------*/
                              $item = "SELECT * FROM item";
                              $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
                              /*--------------------item shipping table have item-------------------------*/ 
                              if(mysqli_num_rows($item_result) > 0){
                                while ($item_result_row = $item_result-> fetch_assoc()){
                                  echo'<option value="'.$item_result_row['barcode'].'">';
                                }
                              }
                          ?>
                        </datalist>
                      </div>
                    </div>
                    <div class="col-md-1 pr-1">
                      <div class="form-group">
                        <a class="feed_barcode">
                          <i class="nc-icon nc-camera-compact"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                        <label>Feedback Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="feedtital">
                      </div>
                    </div>
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                        <label>Feedback</label>
                        <textarea class="form-control" rows="6" cols="100" placeholder="Write Some Thing..." name="feedfeed">
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Send</button>
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
  <div class="modal fade custom_search_pop" id="itemeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog" id="model_d" role="document">
        <div class="model_body">
        
        </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js"></script>
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="demo/demo.js"></script>

  <script type='text/javascript'>
        // load item details
         $(document).ready(function(){

            $('.feed_more').click(function(){
   
                var feedbid = $(this).data('feedid');
                // pass item id
                $.ajax({
                    url: 'exphp/feeddetail.php',
                    type: 'post',
                    data: {feedbid: feedbid},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>

<script type='text/javascript'>
        // load item details
         $(document).ready(function(){

            $('.feed_remove').click(function(){
   
                var feedbid = $(this).data('feedid');
                // pass item id
                $.ajax({
                    url: 'exphp/comform.php',
                    type: 'post',
                    data: {feedbid: feedbid},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>
  <?PHP
  //welcome alert
    if(empty($error_emty)){
        if(empty($error)){
            if(!empty($error_suc)){
                $sesion_error = " Welcome !<b> Faculty of Technology Inventry System</b>";
                echo "<script> demo.showNotification('top','center','".$error_suc."', 'success', 'nc-icon nc-check-2'); </script>";
            }
          }else{
            $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
            echo "<script> demo.showNotification('top','center','".$error."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
          }
    }else{
      $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
      echo "<script> demo.showNotification('top','center','".$error_emty."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
    }
  ?>

</body>
</html>