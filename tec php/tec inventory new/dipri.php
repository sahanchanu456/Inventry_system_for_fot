
<?PHP include 'connection.php' ?>
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
<?php
  $today = date("Y-m-d");
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
            <a href="">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>Depreciation</p>
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
            <a class="navbar-brand" href="">Item Depreciation</a>
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
                <h4 class="card-title"> ALL Inventry Item</h4>
                <div>
                  <button type="button" class="cat_ser_button" id="search_btn">Search</button>
                  <select class="cat_select" id="all_category_filter">
                    <option class="cat_select_option" value="0">All Catagory</option>
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
                  <select class="cat_select" id="sub_category_filter">
                    <option class="cat_select_option" value="0">SUB Catagory</option>
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
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Item Id
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Add Date
                        </th>
                        <th>
                          Warranty
                        </th>
                        <th>
                          Model Name
                        </th>
                        <th>
                          Purchased Company	
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Invoice No
                        </th>
                        <th>
                          Sirial No
                        </th>
                        <th>
                          Current Department
                        </th>
                        <th>
                          GRN
                        </th>
                        <th>
                          Current State
                        </th>
                        <th class="text-right">
                          Depreciation
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tabel_body">
                   
                   <?php
                $item_id = '';
                $item = "SELECT * FROM item";
                $item_result = mysqli_query($conn, $item);
                if(mysqli_num_rows($item_result)>0){
                  while($item_row=mysqli_fetch_assoc($item_result)){
                    $item_id = $item_row['item_id'];
                      echo '
                        <tr>
                        <td>
                          '.$item_row['model_id'].'         
                        </td>
                        <td>
                          '.$item_row['name'].'        
                        </td>
                        <td>
                          '.$item_row['date'].'         
                        </td>
                        <td>
                          '.$item_row['warranty'].'     
                        </td>
                        <td>
                          '.$item_row['name'].'
                        </td>
                        <td>
                          '.$item_row['purchesed_companty'].'       
                        </td>
                        <td>
                          RS .'.$item_row['price'].'       
                        </td>
                        <td>
                          '.$item_row['invoice_no'].'      
                        </td>
                        <td>
                          '.$item_row['serial_number'].'        
                        </td>
                        <td>
                          '.$item_row['current_department'].'        
                        </td>
                        <td>
                          '.$item_row['GRN_no'].'      
                        </td>
                        <td>
                          '.$item_row['current_state'].'                               
                        </td>
                        <td class="exper_table">';
                        
                        $date1=date_create($today);
                        $date2=date_create($item_row['date']);
                        $diff=date_diff($date2,$date1);
                        $y_count = $diff->format("%y");

                        $depriciation = ($item_row['price']*$item_row['depreciation']/100);
                        echo "RS. ".$depriciation;

                        echo'</td> 
                      </tr>';
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
      // display item filter details
        $(document).ready(function(){
            $("#search_btn").click(function(){
              //get select
              var a = document.getElementById("all_category_filter");
              var result1 = a.options[a.selectedIndex].value;

              var b = document.getElementById("sub_category_filter");
              var result2 = b.options[b.selectedIndex].value;

                $("#tabel_body").load("exphp/item_dipri_filter.php",{
                  //pass vaue
                   cat_N:result1,
                   subcat_N:result2
                });
            });
        });
  </script>

   
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
        xmlhttp.open("GET","exphp/diprisearch.php?search="+str,true);
        xmlhttp.send();
    }
</script>
</body>