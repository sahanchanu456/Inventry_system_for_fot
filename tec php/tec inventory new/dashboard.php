
<?PHP include 'connection.php' ?>
<?PHP include 'external.php' ?>
<?PHP
  $error ="";
  $numcount ="0";
  

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

  /*--------------- item--------------------*/
  $item = "SELECT * FROM item";
  $item_result = mysqli_query($conn, $item) or die (mysqli_error($conn));

  /*--------------- catagory--------------------*/
  $cat = "SELECT * FROM category";
  $cat_result = mysqli_query($conn, $cat) or die (mysqli_error($conn));

  /*---------------sub catagory--------------------*/
  $subcat = "SELECT * FROM subcategory";
  $subcat_result = mysqli_query($conn, $subcat) or die (mysqli_error($conn));

  /*---------------model--------------------*/
  $model = "SELECT * FROM model";
  $model_result = mysqli_query($conn, $model) or die (mysqli_error($conn));


  

  if($user_position == "Admin"){
     /*---------------------mantence req count-----------------------*/
     $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' OR state = 'NewAr'";
     $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
     $main_count_row = $main_count_result-> fetch_assoc();
   }else{
     if($user_position == "TO"){
       $dep_id_to = $row['department_id'];
    
        /*---------------------mantence req count-----------------------*/
        $main_count = "SELECT COUNT(`maintenance_id`) FROM maintenance WHERE state = 'New' AND department='$dep_id_to'";
        $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
        $main_count_row = $main_count_result-> fetch_assoc();
      }else{
       if($user_position == "Warden"){
         $dep_id_to = $row['department_id'];
      
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
  <title>RuhTecInventory.lk/Admin</title>
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
        <a href="userprofile.php" class="simple-text logo-mini">
          <div class="logo-image-small">
              <img id="user_img" src=<?php getimage(); ?>>
          </div>
        </a>
        <a href="userprofile.php" class="simple-text logo-normal">
          <p id="user_name"><?php echo $_SESSION['user_name']; ?></p>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        <?PHP
          echo '<li class="active">
                  <a href="dashboard.php">
                    <i class="nc-icon nc-tv-2"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
                <li>
                <a href="itemcatagory.php">
                  <i class="nc-icon nc-bullet-list-67"></i>
                  <p>Item & Catagory </p>
                </a>
              </li>';
          switch ($user_position) {
            case 'Admin':
              echo '<li>
                      <a href="survayform.php">
                        <i class="nc-icon nc-paper"></i>
                        <p>survey</p>
                      </a>
                    </li>';
            case 'Head':
            case 'TO':
            case 'AB':
            case 'Warden':
              echo '<li>
                      <a href="appruemain.php">
                        <i class="nc-icon nc-tap-01"></i>
                        <p>Approve Maintenace</p>
                      </a>
                    </li>
                    <li>
                      <a href="maintenancereq.php">
                        <i class="nc-icon nc-alert-circle-i"></i>
                        <p>Repairing request</p>
                      </a>
                    </li>';
            case 'Lecture':
              echo '<li>
                      <a href="mangeuser.php">
                        <i class="nc-icon nc-badge"></i>
                        <p>Manage User</p>
                      </a>
                    </li>
                    
                    <li>
                      <a href="reportgenarate.php">
                        <i class="nc-icon nc-chart-pie-36"></i>
                        <p>Report Genarate</p>
                      </a>
                    </li>
                    <li>
                      <a href="suplyer.php">
                        <i class="nc-icon nc-ambulance"></i>
                        <p>Manage Suppliers</p>
                      </a>
                    </li>
                    
                    ';
              break;
            case 'Survay':
              echo'<li>
                    <a href="survayform.php">
                      <i class="nc-icon nc-paper"></i>
                      <p>survey</p>
                    </a>
                  </li>';
              
              break;
          }
          echo '<li>
                  <a href="feedback.php">
                    <i class="nc-icon nc-chat-33"></i>
                    <p>Feedback</p>
                  </a>
                </li>
                <li>
                  <a href="userprofile.php">
                    <i class="nc-icon nc-single-02"></i>
                    <p>User Profile</p>
                  </a>
                </li>';
          
        ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Dash Panal</a></p>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">

                <a class="nav-link btn-rotate" href="index.php">
                     <i class="nc-icon nc-button-power"></i>
                </a>
              </li>
              <?php
               if($user_position == "Admin" || $user_position == "TO" || $user_position == "Warden"){
                  echo'<li class="nav-item">
                    <a class="nav-link btn-rotate" href="appruemain.php">';
                        if($main_count_row['COUNT(`maintenance_id`)'] > 0){
                          echo '<div class="notification_count"><p class="not_cou">'.$main_count_row['COUNT(`maintenance_id`)'].'</p></div><i class="nc-icon nc-bell-55"></i>';
                        }else{
                          echo '<i class="nc-icon nc-bell-55"></i>';
                        }
                    echo'</a>
                  </li>';
                }
                if($user_position == "Student" || $user_position == "Lecture"){
                  
                }else{
                  echo'<li class="nav-item">
                    <a class="nav-link btn-rotate" href="setings.php">
                      <i class="nc-icon nc-settings-gear-65"></i>
                    </a>
                  </li>';
                }
              ?>
              <li class="nav_search">
                <form>
                  <div class="input-group no-border">
                    <input type="text" class="form-control" placeholder="Search..." onkeyup="search(this.value)">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="nc-icon nc-zoom-split"></i>
                      </div>
                    </div>
                  </div>
                </form>
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
                <h4 class="card-title"> ALL Inventory Items</h4>
                <p class="error"><?PHP echo $error; ?></p>
                <div>
                  <button type="button" class="cat_ser_button" id="search_butt">Search</button>
                  <select class="cat_select" id="catgory">
                    <option class="cat_select_option" value="0">All Catagory</option>
                    <?php
                      /*--------------------item shipping table have item-------------------------*/ 
                      if(mysqli_num_rows($cat_result) > 0){
                        while ($cat_row = $cat_result-> fetch_assoc()){
                          echo'<option class="month_select_option" value="'.$cat_row['category_id'].'">'.$cat_row['name'].'</option>';
                        }
                      }
                    ?>
                  </select>
                  <select class="cat_select" id="subcatgory">
                    <option class="cat_select_option" value="0">All Sub Catagory</option>
                    <?php
                      /*--------------------item shipping table have item-------------------------*/ 
                      if(mysqli_num_rows($subcat_result) > 0){
                        while ($subcat_row = $subcat_result-> fetch_assoc()){
                          echo'<option class="month_select_option" value="'.$subcat_row['subcategory_id'].'">'.$subcat_row['name'].'</option>';
                        }
                      }
                    ?>
                  </select>
                  <select class="cat_select" id="model">
                    <option class="cat_select_option" value="0">All Model</option>
                    <?php
                      /*--------------------model-------------------------*/ 
                      if(mysqli_num_rows($model_result) > 0){
                        while ($model_row =$model_result-> fetch_assoc()){
                          echo'<option class="month_select_option" value="'.$model_row['model_id'].'">'.$model_row['name'].'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                    <?PHP
                    if($user_position == "Admin" || $user_position == "AB" || $user_position == "Head" || $user_position == "TO" || $user_position == "Servei"){
                        echo'<tr>
                          <th>
                            
                          </th>
                          <th>
                            Item Id
                          </th>
                          <th>
                            Barcode Id
                          </th>
                          <th>
                            Item Name
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Price
                          </th>
                          <th>
                            Serial Number
                          </th>
                          <th>
                            Model
                          </th>
                          <th>
                            Catagory
                          </th>
                          <th>
                            Sub Catagory
                          </th>
                          <th>
                            Invoice Number
                          </th>
                          <th>
                            Warranty
                          </th>
                          <th>
                            Add Date
                          </th>
                          <th>
                            Companty
                          </th>
                          <th>
                            Inventory Page No
                          </th>
                          <th>
                            Current Department
                          </th>
                          <th>
                            GRN Number
                          </th>
                          <th>
                            Move State
                          </th>
                          <th>
                            Owner Department
                          </th>
                          <th>
                            Add user
                          </th>
                          <th>
                          Current State
                          </th>
                          <th class="text-right">
                            
                          </th>
                        </tr>
                        </thead>
                      <tbody id="tabel_body">';
                      
                      /*--------------------item table-------------------------*/ 
                        if(mysqli_num_rows($item_result ) > 0){
                          /*-------------diaplay item ---------------*/
                          while ($item_row = $item_result-> fetch_assoc()){
                            $numcount = $numcount + 1;
                            $item_id = $item_row['item_id'];
                            $barcode = $item_row['barcode'];
                            $date_today=date("Y-m-d");
                            echo'<tr>
                                <td>
                                  '.$numcount.'          
                                </td>
                                <td>
                                  '.$item_row['item_id'].'       
                                </td>
                                <td data-qr='.$barcode.' class="qr_button">
                                '.$item_row['barcode'].'      
                                </td>
                                <td>
                                '.$item_row['name'].'     
                                </td>
                                <td>
                                '.$item_row['description'].'
                                </td>
                                <td>
                                '.$item_row['price'].'      
                                </td>
                                <td>
                                '.$item_row['serial_number'].'      
                                </td>
                                <td>
                                '.$item_row['model_id'].'      
                                </td>
                                <td>
                                '.$item_row['catagory'].'      
                                </td>
                                <td>
                                '.$item_row['sub_catagory'].'      
                                </td>
                                <td>
                                '.$item_row['invoice_no'].'       
                                </td>';
                                  if($item_row['warranty'] > $date_today){
                                    echo'<td class="no_exper_table">
                                            '.$item_row['warranty'].'
                                        </td>';
                                  }else{
                                    echo'<td class="exper_table">
                                            '.$item_row['warranty'].'
                                        </td>';
                                  }
                               echo'<td>
                                '.$item_row['date'].'
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
                                </td>';
                                if($item_row['move_sate'] == "move"){
                                  echo'<td class="exper_table">
                                          Move
                                      </td>';
                                }else{
                                  echo'<td class="no_exper_table">
                                          Not Move
                                      </td>';
                                }
                             echo'<td>
                                '.$item_row['owner_department'].'    
                                </td>
                                <td>
                                '.$item_row['add_user'].'     
                                </td>
                                <td>
                                '.$item_row['current_state'].'     
                                </td>
                                <td class="text-right">
                                  <a href="'.$item_row['pdf'].'" target="_blank"><button type="button" class="shipp_button">PDF</button></a>       
                                </td>
                                <td class="text-right">
                                  <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                                </td>
                              </tr>'; 
                          }                
                        }else{
                          $error = "Table Emty";
                        }
                      }else{
                        if($user_position == "Warden"){
                          echo'<tr>
                            <th>
                              
                            </th>
                            <th>
                              Item Id
                            </th>
                            <th>
                              Barcode Id
                            </th>
                            <th>
                              Item Name
                            </th>
                            <th>
                              Description
                            </th>
                            <th>
                              Price
                            </th>
                            <th>
                              Serial Number
                            </th>
                            <th>
                              Model
                            </th>
                            <th>
                              Catagory
                            </th>
                            <th>
                              Sub Catagory
                            </th>
                            <th>
                              Current Department
                            </th>
                            <th>
                              Owner Department
                            </th>
                            <th>
                              Current State
                            </th>
                            <th class="text-right">
                              
                            </th>
                          </tr>
                          </thead>
                        <tbody id="tabel_body">';
                        
                        /*--------------------item table-------------------------*/ 
                          if(mysqli_num_rows($item_result ) > 0){
                            /*-------------diaplay item ---------------*/
                            while ($item_row = $item_result-> fetch_assoc()){
                              $numcount = $numcount + 1;
                              $item_id = $item_row['item_id'];
                              $barcode = $item_row['barcode'];
                              $date_today=date("Y-m-d");
                              echo'<tr>
                                  <td>
                                    '.$numcount.'          
                                  </td>
                                  <td>
                                    '.$item_row['item_id'].'       
                                  </td>
                                  <td data-qr='.$barcode.' class="qr_button">
                                  '.$item_row['barcode'].'      
                                  </td>
                                  <td>
                                  '.$item_row['name'].'     
                                  </td>
                                  <td>
                                  '.$item_row['description'].'
                                  </td>
                                  <td>
                                  '.$item_row['price'].'      
                                  </td>
                                  <td>
                                  '.$item_row['serial_number'].'      
                                  </td>
                                  <td>
                                  '.$item_row['model_id'].'      
                                  </td>
                                  <td>
                                  '.$item_row['catagory'].'      
                                  </td>
                                  <td>
                                  '.$item_row['sub_catagory'].'      
                                  </td>
                                  <td>
                                    '.$item_row['current_department'].' 
                                  </td>
                                 <td>
                                  '.$item_row['owner_department'].'    
                                  </td>
                                  <td>
                                  '.$item_row['current_state'].'     
                                  </td>
                                  <td class="text-right">
                                    <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                                  </td>
                                </tr>'; 
                            }                
                          }else{
                            $error = "Table Emty";
                          }
                        }else{
                          if($user_position == "Student" || $user_position == "Lecture"){
                            echo'<tr>
                              <th>
                                
                              </th>
                              <th>
                                Barcode Id
                              </th>
                              <th>
                                Item Name
                              </th>
                              <th>
                                Description
                              </th>
                              <th>
                                Serial Number
                              </th>
                              <th>
                                Model
                              </th>
                              <th>
                                Current Department
                              </th>
                              <th>
                                Owner Department
                              </th>
                              <th>
                              Current State
                              </th>
                              <th class="text-right">
                                
                              </th>
                            </tr>
                            </thead>
                          <tbody id="tabel_body">';
                          
                          /*--------------------item table-------------------------*/ 
                            if(mysqli_num_rows($item_result ) > 0){
                              /*-------------diaplay item ---------------*/
                              while ($item_row = $item_result-> fetch_assoc()){
                                $numcount = $numcount + 1;
                                $item_id = $item_row['item_id'];
                                $barcode = $item_row['barcode'];
                                $date_today=date("Y-m-d");
                                echo'<tr>
                                    <td>
                                      '.$numcount.'          
                                    </td>
                                    <td data-qr='.$barcode.' class="qr_button">
                                    '.$item_row['barcode'].'      
                                    </td>
                                    <td>
                                    '.$item_row['name'].'     
                                    </td>
                                    <td>
                                    '.$item_row['description'].'
                                    </td>
                                    <td>
                                    '.$item_row['serial_number'].'      
                                    </td>
                                    <td>
                                    '.$item_row['model_id'].'      
                                    </td>
                                    <td>
                                      '.$item_row['current_department'].' 
                                    </td>
                                   <td>
                                    '.$item_row['owner_department'].'    
                                    </td>
                                    <td>
                                    '.$item_row['current_state'].'     
                                    </td>
                                    <td class="text-right">
                                      <a href="#"  data-itemid='.$item_id.' class="img_button"><button type="button" id="myBtn" class="shipp_button">Image</button></a>       
                                    </td>
                                  </tr>'; 
                              }                
                            }else{
                              $error = "Table Emty";
                            }
                          }else{
                            
                          }  
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
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="demo/demo.js"></script>
  
  <script type='text/javascript'>
    //respons search
    function search(str) {
        if (str.length==0) {
            document.getElementById("tabel_body").innerHTML="";
        
            return;
        }
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        } else {  
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("tabel_body").innerHTML=this.responseText
            }
        }
        xmlhttp.open("GET","exphp/dashsearch.php?search="+str,true);
        xmlhttp.send();
    }

  </script>
  <script type='text/javascript'>
        // load item details
         $(document).ready(function(){

            $('.img_button').click(function(){
   
                var itemid = $(this).data('itemid');
                // pass item id
                $.ajax({
                    url: 'exphp/itemdetail.php',
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
  <script type='text/javascript'>
        // load qr
         $(document).ready(function(){

            $('.qr_button').click(function(){
   
                var itemqr = $(this).data('qr');
                // pass item qr
                $.ajax({
                    url: 'exphp/qrdisplay.php',
                    type: 'post',
                    data: {itemqr: itemqr},
                    success: function(response){ 
                        
                        $('.model_body').html(response); 

                        $('#itemeModalCenter').modal('show'); 
                    }
                }); 
            });
        }); 
  </script>
  <script>
    $(document).ready(function() {
      demo.initChartsPages();
    });
  </script>
   <script type='text/javascript'>
      // display item filter details
        $(document).ready(function(){
            $("#search_butt").click(function(){
              //get select
              var a = document.getElementById("catgory");
              var result1 = a.options[a.selectedIndex].value;

              var b = document.getElementById("subcatgory");
              var result2 = b.options[b.selectedIndex].value;

              var c = document.getElementById("model");
              var result3 = c.options[c.selectedIndex].value;

                $("#tabel_body").load("exphp/itemfilter.php",{
                  //pass vaue
                   cat_N:result1,
                   subcat_N:result2,
                   model_N:result3
                });
            });
        });
  </script>
  <?PHP
  //welcome alert
    if(!empty($log_user_id) && !empty($user_position)){
      $sesion_error = " Welcome !<b> Faculty of Technology Inventory System</b>";
      echo "<script> demo.showNotification('top','center','".$sesion_error."', 'success', 'nc-icon nc-bank'); </script>";
    }else{
      $sesion_error = " Sesion Error !<b> Plase Log In Again</b>";
      echo "<script> demo.showNotification('top','center','".$sesion_error."', 'danger', 'nc-icon nc-alert-circle-i'); </script>";
    }
  ?>
</body>

</html>
