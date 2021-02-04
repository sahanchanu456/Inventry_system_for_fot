
<?PHP include 'connection.php' ?>
<?PHP include 'external.php' ?>
<?PHP


  $error ="";
  $errore ="";
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
   /*--------------- maintenance--------------------*/
   $maint = "SELECT * FROM maintenance ORDER BY maintenance_id DESC";
   $maint_result = mysqli_query($conn, $maint) or die (mysqli_error($conn));

    /*---------------to be maintenance--------------------*/
    $maint_to = "SELECT * FROM maintenance WHERE state = 'New' OR state = 'NewAr' ORDER BY maintenance_id DESC";
    $maint_to_result = mysqli_query($conn, $maint_to) or die (mysqli_error($conn));

    /*---------------------mantence req count-----------------------*/
    $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' OR state = 'NewAr'";
    $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
    $main_count_row = $main_count_result-> fetch_assoc();
  }else{
    if($user_position == "TO"){
      $dep_id_to = $row['department_id'];

      /*--------------- maintenance--------------------*/
      $maint = "SELECT * FROM maintenance WHERE department='$dep_id_to' ORDER BY maintenance_id DESC";
      $maint_result = mysqli_query($conn, $maint) or die (mysqli_error($conn));
   
       /*---------------to be maintenance--------------------*/
       $maint_to = "SELECT * FROM maintenance WHERE department='$dep_id_to' AND state = 'New' ORDER BY maintenance_id DESC";
       $maint_to_result = mysqli_query($conn, $maint_to) or die (mysqli_error($conn));
   
       /*---------------------mantence req count-----------------------*/
       $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' AND department='$dep_id_to'";
       $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
       $main_count_row = $main_count_result-> fetch_assoc();
     }else{
      if($user_position == "Warden"){
        $dep_id_to = $row['department_id'];
  
        /*--------------- maintenance--------------------*/
        $maint = "SELECT * FROM maintenance WHERE department='$dep_id_to' ORDER BY maintenance_id DESC";
        $maint_result = mysqli_query($conn, $maint) or die (mysqli_error($conn));
     
         /*---------------to be maintenance--------------------*/
         $maint_to = "SELECT * FROM maintenance WHERE department='$dep_id_to' AND state = 'New' ORDER BY maintenance_id DESC";
         $maint_to_result = mysqli_query($conn, $maint_to) or die (mysqli_error($conn));
     
         /*---------------------mantence req count-----------------------*/
         $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' AND department='$dep_id_to'";
         $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
         $main_count_row = $main_count_result-> fetch_assoc();
       }else{
     
       }
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
            <a href="appruemain.php">
              <i class="nc-icon nc-tap-01"></i>
              <p>Approve Maintenace</p>
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
            <a class="navbar-brand" href="">Approve Maintenance</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="index.php">
                  <i class="nc-icon nc-button-power"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="appruemain.php">
                <?php
                    if($main_count_row['COUNT(`maintenance_id`)'] > 0){
                      echo '<div class="notification_count"><p class="not_cou">'.$main_count_row['COUNT(`maintenance_id`)'].'</p></div><i class="nc-icon nc-bell-55"></i>';
                    }else{
                      echo '<i class="nc-icon nc-bell-55"></i>';
                    }
                  ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="moverequestlist.php">
                <?php
                    if($main_count_row['COUNT(`maintenance_id`)'] > 0){
                      echo '<div class="notification_count"><p class="not_cou">'.request($conn).'</p></div><i class="nc-icon nc-settings"></i>';
                    }else{
                      echo '<i class="nc-icon nc-settings"></i>';
                    }
                  ?>
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
                <h4 class="card-title"> To Be Approved</h4>
              </div>
              
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          
                        </th>
                        <th>
                          QR code
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Department
                        </th>
                        <th>
                          Note
                        </th>
                        <th>
                          State
                        </th>
                        <th>
                          Add Date
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                    <?PHP
                      /*--------------------item table-------------------------*/ 
                        if(mysqli_num_rows($maint_to_result) > 0){
                          /*-------------diaplay item ---------------*/
                          while ($maint_to_row = $maint_to_result-> fetch_assoc()){
                            $numcount = $numcount + 1;
                            $maint_id = $maint_to_row['maintenance_id'];
                            $maint_item_id = $maint_to_row['item_id'];
                            $maint_user_id = $maint_to_row['user_id'];
                            $maint_user_state = $maint_to_row['user_state'];
                            /*------item details for feed-----*/
                            $item = "SELECT * FROM item WHERE item_id = '$maint_item_id'";
                            $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
                            $item_row = $item_result-> fetch_assoc();
                            /*----user details------*/
                            if($maint_user_state == "student"){
                              $user = "SELECT * FROM student WHERE student_id='$maint_user_state'";
                              $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                              $user_row = $user_result-> fetch_assoc();
                            }else{
                              $user = "SELECT * FROM staff WHERE staff_id='$maint_user_id' AND job_position='$maint_user_state'";
                              $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                              $user_row = $user_result-> fetch_assoc();
                            }
                            if(($user_position == "Admin" && $maint_to_row['state'] == "NewAr") || ($maint_to_row['state'] == "New" &&  $maint_to_row['department'] == "othe")){
                              echo'<tr class="exper_table">
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
                                '.$maint_to_row['department'].'     
                                </td>
                                <td>
                                  <i data-mainid='.$maint_id.' class="nc-icon nc-share-66" ></i>
                                </td>';
                                  if($maint_to_row['state'] == "New"){
                                    echo'<td>
                                      NO Apprue
                                    </td>';
                                  }else{
                                    echo'<td>
                                      AR To Apprue
                                    </td>';
                                  }
                                echo'<td>
                                '.$maint_to_row['add_date'].'      
                                </td>
                              </tr>';
                            }else{
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
                                '.$maint_to_row['department'].'     
                                </td>
                                <td>
                                  <i data-mainid='.$maint_id.' class="nc-icon nc-share-66" ></i>
                                </td>';
                                  if($maint_to_row['state'] == "New"){
                                    echo'<td>
                                      NO Apprue
                                    </td>';
                                  }else{
                                    echo'<td>
                                      AR To Apprue
                                    </td>';
                                  }
                                echo'<td>
                                '.$maint_to_row['add_date'].'      
                                </td>
                              </tr>';
                            }
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
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Maintenance Requests</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          
                        </th>
                        <th>
                          QR Code
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Department
                        </th>
                        <th>
                          Note
                        </th>
                        <th>
                          Add Date
                        </th>
                        <th>
                          State
                        </th>
                        <th>
                          Approved Date
                        </th>
                        <th>
                          Approved user id
                        </th>
                        <th>
                          Approved user state
                        </th>
                        <th class="text-right">
                          Approved user note
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                    <?PHP
                      /*--------------------item table-------------------------*/ 
                        if(mysqli_num_rows($maint_result) > 0){
                          /*-------------diaplay item ---------------*/
                          while ($maint_row = $maint_result-> fetch_assoc()){
                            $numcount = $numcount + 1;
                            $maint_id = $maint_row['maintenance_id'];
                            $maint_item_id = $maint_row['item_id'];
                            $maint_user_id = $maint_row['user_id'];
                            $maint_user_state = $maint_row['user_state'];
                            /*------item details for feed-----*/
                            $item = "SELECT * FROM item WHERE item_id = '$maint_item_id'";
                            $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));
                            $item_row = $item_result-> fetch_assoc();
                            /*----user details------*/
                            if($maint_user_state == "student"){
                              $user = "SELECT * FROM student WHERE student_id='$maint_user_state'";
                              $user_result = mysqli_query($conn, $user) or die (mysqli_error($conn));
                              $user_row = $user_result-> fetch_assoc();
                            }else{
                              $user = "SELECT * FROM staff WHERE staff_id='$maint_user_id' AND job_position='$maint_user_state'";
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
                                '.$maint_row['department'].'     
                                </td>
                                <td>
                                   <i data-mainid='.$maint_id.' class="nc-icon nc-tap-01" ></i>
                                </td>
                                <td>
                                '.$maint_row['add_date'].'      
                                </td>';
                                  if($maint_row['state'] == "New" || $maint_row['state'] == "NewAr"){
                                    echo '<td class="exper_table">
                                          Loading...
                                        </td>';
                                  }else{
                                    
                                      echo '<td class="no_exper_table">
                                            Apprue
                                          </td>';
                                    
                                  }    
                                  if($maint_row['apprue_date'] == NULL){
                                    echo '<td class="exper_table">
                                          Pending...
                                        </td>';
                                  }else{
                                    
                                      echo '<td class="no_exper_table">
                                            '.$maint_row['apprue_date'].'
                                          </td>';
                                  }    
                                  if( $maint_row['apprue_user_id']  == "No"){
                                    echo '<td class="exper_table">
                                          Pending...
                                        </td>';
                                  }else{
                                    
                                      echo '<td class="no_exper_table">
                                            '.$maint_row['apprue_user_id'].'
                                          </td>';
                                  }         
                                  if($maint_row['apprue_user_state'] == "No"){
                                    echo '<td class="exper_table">
                                          Pending...
                                        </td>';
                                  }else{
                                    
                                      echo '<td class="no_exper_table">
                                            '.$maint_row['apprue_user_state'].'
                                          </td>';
                                  }         
                                  if($maint_row['apprue_user_note'] == "No"){
                                    echo '<td class="exper_table">
                                          Pending...
                                        </td>';
                                  }else{
                                    
                                      echo '<td class="no_exper_table">
                                            '.$maint_row['apprue_user_note'].'
                                          </td>';
                                  }       
                                echo'</tr>'; 
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

            $('.nc-tap-01').click(function(){
   
                var mainid = $(this).data('mainid');
                // pass item id
                $.ajax({
                    url: 'exphp/mainnote.php',
                    type: 'post',
                    data: {maimid: mainid},
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

            $('.nc-share-66').click(function(){
   
                var mainid = $(this).data('mainid');
                // pass item id
                $.ajax({
                    url: 'exphp/mainappnote.php',
                    type: 'post',
                    data: {maimid: mainid},
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
        if(empty($errore)){
            if(!empty($error_suc)){
                $sesion_error = " Welcome !<b> Faculty of Technology Inventry System</b>";
                echo "<script> demo.showNotification('top','center','".$error_suc."', 'success', 'nc-icon nc-check-2'); </script>";
            }
          }else{
            $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
            echo "<script> demo.showNotification('top','center','".$errore."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
          }
    }else{
      $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
      echo "<script> demo.showNotification('top','center','".$error_emty."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
    }
  ?>

</body>
</html>