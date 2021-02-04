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
    $password = md5("12345");
    if ($job_position=='Admin') {
    	if (isset($_GET['stfid'])) {
    		$id=$_GET['stfid'];

    		$query = "UPDATE staff SET password='{$password}' WHERE staff_id='{$id}' LIMIT 1";
    		$result = mysqli_query($conn,$query);
    		if ($result) {
    			//success msg...........
                echo '<script type="text/javascript">'; 
                echo 'alert("Reset is succed...");'; 
                echo 'window.location.href = "mangeuser.php";';
                echo '</script>';
    		}else{
    			
    		}
    	}else if (isset($_GET['stdid'])) {
            $id=$_GET['stdid'];
            $query = "UPDATE student SET password='{$password}' WHERE student_id='{$id}' LIMIT 1";
                $result = mysqli_query($conn,$query);
                if ($result) {
                    //success msg............
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Reset is succed...");'; 
                    echo 'window.location.href = "mangestudent.php";';
                    echo '</script>';
                }else{
                    //error msg............
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Not succed!!!!");'; 
                    echo 'window.location.href = "mangestudent.php";';
                    echo '</script>';
                }
        }else{
    		//awla kiyla alert 1k denna..............
            echo '<script type="text/javascript">'; 
            echo 'alert("Not succed!!!!");'; 
            echo 'window.location.href = "dashboard.php";';
            echo '</script>';
    	}
    }else{
    	header('Location:dashboard.php');
    }
  }else{
    header('Location:dashboard.php');
    //$job_position = "admin";
  }



 ?>