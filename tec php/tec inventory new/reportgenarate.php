
<?php
  require_once('connection.php');
?>

<?php
          $error="";
          /*---------load item table------*/
         $item="SELECT * FROM item";
         $item_result=mysqli_query($conn,$item) or die (mysql_error($conn)); 


?>



<!DOCTYPE html>
<html lang="en">




<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/teclog.png">
  <link rel="icon" type="image/png" href="img/teclog.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>RuhTecInventory.lk/Report</title>
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
              <li>
                <a href="survayreport.html">
                  <i class="nc-icon nc-badge"></i>
                  <p>Survey Report</p>
                </a>
              </li>
              <li>
                <a href="oldsurveyreport.html">
                  <i class="nc-icon nc-badge"></i>
                  <p>Old Survey Report</p>
                </a>
              </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">Report</a>
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
              <li class="nav_search">
                <form>
                  <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." name=""><!---add name get text in search -->
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
                <p class="error"> <?php echo $error; ?> </p> 
                <div>
                  <select class="cat_select" id="cat">
                    <option value="0"> No select </option>
                    <?php
                      $sql="SELECT * FROM subcategory";
                      $result=mysqli_query($conn,$sql);
                      if (mysqli_num_rows($item_result) > 0) {
                        while($row=mysqli_fetch_assoc($result)){
                          echo '<option class="" value="'.$row['subcategory_id'].'">'.$row['name'].'</option>';
                        }
                      }else{
                        echo "<option>error loding</option>";
                      }
                    ?>
                    </select>


                  <select class="cat_select" id="model">
                   <option value="0"> No select </option>
                    <?php
                      $sql="SELECT * FROM model";
                      $result=mysqli_query($conn,$sql);
                      while($row=mysqli_fetch_assoc($result)){
                        echo '<option class="" value="'.$row['subcategory_id'].'">'.$row['name'].'</option>';
                      }
                    ?>

                  </select>
                  <button type="button" class="cat_ser_button" name="filter" id="filter_btn">filter
                  </button>

                   <button id="pdf_btn" type="submit" class="cat_ser_button">PDF</button> 

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
                          barcode
                        </th>
                        <th>
                          name
                        </th>
                        <th>
                          description
                        </th>
                        <th>
                          price
                        </th>
                        <th>
                          serial_number
                        </th>
                        <th>
                          model_no
                        </th>
                        <th>
                          invoice_no	
                        </th>
                        <th>
                          warranty
                        </th>
                        <th>
                          date
                        </th>
                        <th>
                          purchesed_companty
                        </th>
                        <th>
                          inventory_page_no
                        </th>
                        <th>
                          current_department
                        </th>
                        <th>
                          GRN_no
                        </th>
                        <th>
                          move_sate
                        </th>
                        <th>
                          owner_department
                        </th>
                        <th>
                          current_state
                        </th>
                        <th class="text-right">
                         add_user
                        </th>
                      </tr>
                      </thead>
                    <tbody id="tabel_body">
                      <?php
                          if(mysqli_num_rows($item_result) > 0){
                              while($item_row=mysqli_fetch_assoc($item_result)){
                                  
                                  echo '
                                    <tr>
                                    <td>
                                      '.$item_row['item_id'].'          
                                    </td>
                                    <td>
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
                                         '.$item_row['invoice_no'].'     
                                    </td>
                                    <td>
                                      '.$item_row['warranty'].'      
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                      '.$item_row['move_sate'].'      
                                    </td>
                                    <td>
                                      '.$item_row['owner_department'].'      
                                    </td>
                                    <td>
                                      '.$item_row['current_state'].'      
                                    </td>
                                    <td class=\"text-right\"> 
                                      '.$item_row['add_user'].'  
                                    </td>
                                    </tr>';
                            }
                          }else{
                            $error="table empty";  
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
      // display report filter details
        $(document).ready(function(){
            $("#filter_btn").click(function(){
              //get select
              var a = document.getElementById("cat");
              var result1 = a.options[a.selectedIndex].value;

              var b = document.getElementById("model");
              var result2 = b.options[b.selectedIndex].value;


                $("#tabel_body").load("exphp/reportfilter.php",{
                  //pass vaue
                   cat_N:result1,
                   model_N:result2
                });
            });
        });
  </script>

  <script type='text/javascript'>
      // display report filter details
        $(document).ready(function(){
            $("#pdf_btn").click(function(){
              //get select
              var c = document.getElementById("cat");
              var result1 = c.options[c.selectedIndex].value;

              var d = document.getElementById("model");
              var result2 = d.options[d.selectedIndex].value;


                $("#tabel_body").load("exphp/multicell-table.php",{
                  //pass vaue
                   cat_N:result1,
                   model_N:result2
                });
            });
        });
  </script>
</body>

</php>

