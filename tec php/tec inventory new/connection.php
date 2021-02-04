<?PHP 
  if(session_status()== PHP_SESSION_NONE){
	session_start();
  }
?>
<?php 
	if (isset($_SESSION['job_position'])) {
		$user_position = $_SESSION['job_position'];
		$log_user_id = $_SESSION['user_id'];

		if($user_position == "Admin"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "TO"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Assistant"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Student"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Servei"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "AB"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Head"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Warden"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else if($user_position == "Lecture"){
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}else{
			$conn = mysqli_connect('localhost','root','','inventory_of_fot');
		}

	}else{
		$conn = mysqli_connect('localhost','root','','inventory_of_fot');
	}

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	  }

 ?>