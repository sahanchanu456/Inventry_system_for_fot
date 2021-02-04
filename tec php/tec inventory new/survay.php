<?PHP include 'connection.php';?>
<?php 
  $today= date("Y-m-d");
  $survay_id="";

$survay_tem="SELECT * FROM surver_data_tempory";
$survay_tem_result = mysqli_query($conn,$survay_tem) or die (mysql_error($conn));

  $sql="SELECT * FROM survey_information ORDER BY surve_id DESC LIMIT 1";
  $result = mysqli_query($conn,$sql);
  if ($result) {
    if (mysqli_num_rows($result)==1) {
      while ($detail=mysqli_fetch_assoc($result)) {
        $survay_id=$detail['surve_Id'];
      }
    }
  }

     if(isset($_POST['submit4'])){
    $surver_cdp = $conn->real_escape_string($_POST['dep']);
    $surver_state = $conn->real_escape_string($_POST['state']);
    $qr = $conn->real_escape_string($_POST['qr']);

    $details="SELECT * FROM item WHERE barcode = '$qr'";
    $details_result=mysqli_query($conn,$details) or die (mysql_error($conn)); 
    $details_result_result= $details_result->fetch_assoc();

    $itemid=$details_result_result['item_id'];
    $itemname=$details_result_result['name'];
    $itemdepartment=$details_result_result['owner_department'];
    $modelid=$details_result_result['model_id'];
    $maincatagory=$details_result_result['catagory'];
    $catagory=$details_result_result['sub_catagory'];
    $movestate=$details_result_result['move_sate'];
    $warrantyW=$details_result_result['warranty'];
    $adduser=$details_result_result['add_user'];
    $movedepartment=$details_result_result['current_department'];


$insert_data="INSERT INTO surver_data_tempory(surve_id,date,item_id,item_name,item_department,model_id,main_catagory,catagory,move_state,warranty,add_user,move_department,current_department,current_state)
    VALUES ('$survay_id', '$today', '$itemid', '$itemname', '$itemdepartment', '$modelid','$maincatagory','$catagory','$movestate','$warrantyW','$adduser','$movedepartment','$surver_cdp','$surver_state')";
     $insert_data_result = mysqli_query($conn,$insert_data) or die (mysqli_error($conn));
    
    
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Survey</title>
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
            <li class="active">
                <a href="dashboard.html">
                  <i class="nc-icon nc-badge"></i>
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
            <a class="navbar-brand" href="">New Survey</a>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="bar code read link karanna">
                  <img src="img/bar.png" width="70" height="70" title="Click here to scan QR code" alt="Click here to scan QR code" />
                </a>
              </li>
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
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Add Item Survey</h4>
                <div>


  <form action="survay.php" method="post" enctype ="multipart/form-data">
  <center><input type="text" name="qr" id="qrcode" autofocus placeholder="QR" onkeyup="search(this.value)" ></center><br>
  
  



                  <a href="exphp/endsurvay.php"><button type="button" class="cat_ser_button" >End Survey</button></a>
                  <a href="survayform.php"><button type="button" class="cat_ser_button" >Pause Survey</button></a>
                  
                  <select class="cat_select" id="dept" name="dep">';
                            <?php
                                 $cdepid = $code_detal_result['current_department'];
                              $sql="SELECT * FROM department where department_id='{$cdepid}' LIMIT 1";
                              $sql_result=mysqli_query($conn,$sql);
                              $result=$sql_result->fetch_assoc();


                                 
                                $sql="SELECT * FROM department";
                                $department=mysqli_query($conn,$sql);
                                while($row=$department->fetch_assoc()){
                                  if ($result['name']==$row['name']) {
                                    echo '<option class="" value="'.$row['name'].'" select="selected">'.$row['name'].'</option>';
                                  }else{
                                    echo '<option class="" value="'.$row['name'].'">'.$row['name'].'</option>';
                                  }
                                  
                                }

                            ?>
                        </select>       
                            
                            
                              <select class="cat_select" id="status" name="state">
                                <option class="cat_select_option" value="0">Current State</option>
                                <option class="month_select_option" value="good">good</option>
                                <option class="month_select_option" value="return to wellamadama">return to wellamadama</option>
                                <option class="month_select_option" value="disposed">disposed</option>
                              </select>   
                            
                              <button type="submit" name="submit4" class="btn btn-primary btn-round">Add</button>
                            </form>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Date
                        </th>
                        <th>
                          Item Id
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Item Dpartment
                        </th>
                        <th>
                          Model Name
                        </th>
                        <th>
                         Main Catagory
                        </th>
                        <th>
                          Catagory
                        </th>
                        <th>
                          Move Sate
                        </th>
                        <th>
                          Warranty
                        </th>
                        <th>
                          Add User
                        </th>
                        <th>
                          Move Department
                        </th>
                        <th>
                          Current Department
                        </th>
                        <th class="text-right">
                          Current State
                        </th>
                      </tr>
                      </thead>
                    <tbody id="tabel_body">                      
                    </tbody>
                  </table>
                </div>
              </div>




              <div class="card-body">
                <div class="table-responsive" id="max_tabel_hight">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Survey Id
                        </th>
                        <th>
                          Date
                        </th>
                        <th>
                          Item Id
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Item Dpartment
                        </th>
                        <th>
                          Model ID
                        </th>
                        <th>
                         Main Catagory
                        </th>
                        <th>
                          Catagory
                        </th>
                        <th>
                          Move Sate
                        </th>
                        <th>
                          Warranty
                        </th>
                        <th>
                          Add User
                        </th>
                        <th>
                          Move Department
                        </th>
                        <th>
                          Current Department
                        </th>
                        <th class="text-right">
                          Current State
                        </th>
                      </tr>
                      </thead>                         
                    <tbody id="tabel_body"> 
                      <?php
                        if(mysqli_num_rows($survay_tem_result ) > 0){
                        while ($survay_tem_row = $survay_tem_result-> fetch_assoc()){
                          echo '<tr>
                          
                          <td>
                             '.$survay_tem_row['surve_id'].'
                                  
                          </td>
                          <td>
                              '.$survay_tem_row['date'].'          
                          </td>
                          <td>
                              '.$survay_tem_row['item_id'].'      
                          </td>
                          <td>
                             '.$survay_tem_row['item_name'].' 
                          </td>
                           <td>
                             '.$survay_tem_row['item_department'].' 
                          </td>
                            <td>
                              '.$survay_tem_row['model_id'].'        
                            </td>
                            <td>
                              '.$survay_tem_row['main_catagory'].'        
                            </td>
                            <td>
                              '.$survay_tem_row['catagory'].'        
                            </td>
                            <td>
                              '.$survay_tem_row['move_state'].'      
                            </td>
                            <td>
                              '.$survay_tem_row['warranty'].'        
                          </td>
                          <td>
                              '.$survay_tem_row['add_user'].'       
                          </td>
                            
                         <td>
                             '.$survay_tem_row['move_department'].'
                         </td>
                          
                         <td>
                             '.$survay_tem_row['current_department'].'
                         </td>
                         <td>
                             '.$survay_tem_row['current_state'].'
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
        xmlhttp.open("GET","exphp/qrread.php?qrcode="+str,true);
        xmlhttp.send();
    }

  </script>


</body>
</html>

