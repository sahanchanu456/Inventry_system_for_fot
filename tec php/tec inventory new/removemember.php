<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 
?>
<?php require_once('external.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  if (isset($_SESSION['job_position'])) {
    $job_position = $_SESSION['job_position'];
    if ($job_position=='Admin') {
    	if (isset($_GET['id'])) {
    	   $id=$_GET['id'];
    	   $query = "UPDATE staff SET state='Retire' WHERE staff_id = '{$id}' LIMIT 1";
    	   $result = mysqli_query($conn,$query);
    	   if ($result) {
    	   	//put a msg ..........................
                echo '<script type="text/javascript">'; 
                echo 'alert("Update is succed...");'; 
                echo 'window.location.href = "mangeuser.php";';
                echo '</script>';
    	   }
    		
    	}
    }else{
    	header('Location:dashboard.php');
    }
  }else{
    header('Location:dashboard.php');
    //$job_position = "admin";
  }

 ?>