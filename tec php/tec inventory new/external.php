<?php 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	} 
?>

<?php 
	function maintenance($conn){
		$job_position="";
		$ncount=0;
		$job_position = get_user_job_position();

		$main_count_result="";
		$main_count_row="";

		if($job_position == "Admin"){
   		  /*---------------------mantence req count-----------------------*/
   		  $main_count = "SELECT COUNT(maintenance_id) FROM maintenance WHERE state = 'New' OR state = 'NewAr'";
   		  $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
   		  $main_count_row = $main_count_result-> fetch_assoc();

   		  //$ncount=$main_count_row+request($conn);
   		}else{
   		  if($job_position == "TO"){
   		    $dep_id_to = $_SESSION['department_id'];
   		 
   		     /*---------------------mantence req count-----------------------*/
   		     $main_count = "SELECT COUNT(maintenance_id) FROM maintenance WHERE state = 'New' AND department='$dep_id_to'";
   		     $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
   		     $main_count_row = $main_count_result-> fetch_assoc();

   		     $ncount=$main_count_row+request($conn);
   		   }else{
   		    if($job_position == "Warden"){
   		      $dep_id_to = $_SESSION['department_id'];
   		   
   		       /*---------------------mantence req count-----------------------*/
   		       $main_count = "SELECT COUNT(maintenance_id) FROM maintenance WHERE state = 'New' AND department='$dep_id_to'";
   		       $main_count_result = mysqli_query($conn, $main_count) or die (mysqli_error($conn));
   		       $main_count_row = $main_count_result-> fetch_assoc();

   		       $ncount=$main_count_row+request($conn);
   		     }else{
   		   
   		     }
   		   }
   		}

   		
   		$ncount=mysqli_num_rows($main_count_result)+request($conn);
		

        return $ncount;
             
	}

	function request($conn){
		$user_id=$_SESSION['user_id'];
		$department_id=$_SESSION['department_id'];
		$count=0;

		$sql = "SELECT move_id FROM move WHERE current_department='{$department_id}' AND status IS NULL";
		$result = mysqli_query($conn,$sql);
		if ($result) {
			$count = mysqli_num_rows($result);
		}
		return $count;

	}

	function navigation($conn){
		$count = 0;
		$count= maintenance($conn)+request($conn);
		
		echo '<li class="nav-item">';
	      echo '<a class="nav-link btn-rotate" href="index.php">';
	        echo '<i class="nc-icon nc-button-power"></i>';
	      echo '</a>';
	    echo '</li>';
	    echo '<li class="nav-item">';
	      echo '<a class="nav-link btn-rotate" href="appruemain.php">';
	        echo '<div class="notification_count"><p class="not_cou">'.$count.'</p></div><i class="nc-icon nc-bell-55"></i>;';
	      echo '</a>';
	    echo '</li>';
	    echo '<li class="nav-item">';
	      echo '<a class="nav-link btn-rotate" href="link setting page">';
	        echo '<i class="nc-icon nc-settings-gear-65"></i>';
	      echo '</a>';
	    echo '</li>';
	}

	function getimage(){
		if($_SESSION['image'] != NULL || $_SESSION['image'] != ""){
          echo $_SESSION['image'];
        }else{
          echo 'img\user\avator.png';
        }
	}
 ?>

<?php 

	//check empty fild......
	//global $conn;
	function check_empty($req_field){
		$error=array();
		foreach ($req_field as $value) {
			if(empty(trim($_POST[$value]))){
				$error[]=$value.' is required';
			}
		}
		//$error[]="test";
		return $error;
	}

	function check_length($max_length){
		$error=array();
		foreach ($max_length as $fild => $lenth) {
			if(strlen(trim($_POST[$fild])) > $lenth){
				$error[]=$fild.' must be less than '.$lenth.' characters';
			}
		}
		return $error;
	}

	function print_error($error,$lenth_error){
		if(!empty($error)){
			//echo "<div class=\"error\">";
			foreach ($error as $display) {
				echo $display."<br>";
			}
			//echo "</div>";
		}
		if(!empty($lenth_error)){
			//echo "<div class=\"lerror\">";
			foreach ($lenth_error as $value) {
				echo $value."<br>";
			}
			//echo "</div>";
		
		}
	}

	function get_user_id(){
		if (isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			return $user_id;
		}else{
			return "error";
		}
		
	}

	function get_user_job_position(){
		if (isset($_SESSION['job_position'])) {
			$job_position = $_SESSION['job_position'];
			return $job_position;
		}else{
			return "error";
		}
		
	}

	if (isset($_POST['remove'])) {
		$id = $_POST['remove'];
		echo $id;
	}



	//uddika......................
	function logout(){
		$_SESSION['user_id'] = NULL;
		$_SESSION['user_name'] = NULL;
		$_SESSION['job_position'] = NULL;
		$_SESSION['dep_name'] = NULL;
		$_SESSION['department_id'] = NULL;

		header('Location:index.php');
	}

	function check_admin(){
		if (isset($_SESSION['job_position'])) {
		    if ($_SESSION['job_position']!='Admin') {
		      echo '<script type="text/javascript">';
		        echo 'alert("You can\'t accses this page...")';
		      echo '</script>';
		      header('Location:dashboard.php');
		    }
		}else{
		    echo '<script type="text/javascript">';
		      echo 'alert("You can\'t accses this page...")';
		    echo '</script>';
		    header('Location:dashboard.php');
		}
	}

	function check_ab(){
		if (isset($_SESSION['job_position'])) {
		    if ($_SESSION['job_position']!='AB') {
		      echo '<script type="text/javascript">';
		        echo 'alert("You can\'t accses this page...")';
		      echo '</script>';
		      header('Location:dashboard.php');
		    }
		}else{
		    echo '<script type="text/javascript">';
		      echo 'alert("You can\'t accses this page...")';
		    echo '</script>';
		    header('Location:dashboard.php');
		}
	}

	function check_admin_ab(){
		if (isset($_SESSION['job_position'])) {
		    if ($_SESSION['job_position']!='AB' || $_SESSION['job_position']!='Admin') {
		      echo '<script type="text/javascript">';
		        echo 'alert("You can\'t accses this page...")';
		      echo '</script>';
		      header('Location:dashboard.php');
		    }
		}else{
		    echo '<script type="text/javascript">';
		      echo 'alert("You can\'t accses this page...")';
		    echo '</script>';
		    header('Location:dashboard.php');
		}
	}

 ?>