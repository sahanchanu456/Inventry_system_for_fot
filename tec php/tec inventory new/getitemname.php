<?php 

	require_once('connection.php');
	require_once('external.php');

	if (isset($_POST['barcode'])) {
		$barcode=$_POST['barcode'];
		$name = NULL;
		$CurrentDepartment = NULL;

		$statement="SELECT * FROM item where barcode='{$barcode}' LIMIT 1";
		$result = mysqli_query($conn,$statement);
		if ($result) {
			while ($detail = mysqli_fetch_assoc($result)) {
				$name = $detail['name'];
				$CurrentDepartment = $detail['current_department'];

				
			}
			if ($name==NULL) {
				echo "invalid barcode";
			}else{
				$return = array($name,$CurrentDepartment);
				echo json_encode($return);
				//echo $name.$CurrentDepartment;
			}
		}else{
			echo "invalid barcode";
		}
	}else{
		//echo "Barcode Error!";
	}


	if (isset($_POST['name'])) {
		$name = $_POST['name'];

		$query = "SELECT name FROM item WHERE name LIKE '%{$name}%' LIMIT 10";
		$result = mysqli_query($conn,$query);
		if ($query) {
			if (mysqli_num_rows($result)>0) {
				$suggesetion="";
				while ($detail = mysqli_fetch_assoc($result)) {
					$suggesetion.= "<div id=\"sug\">".$detail['name']."</div><br>";
				}
				//echo json_encode($suggesetion);
				echo $suggesetion;
			}else{
				echo "not match";
			}
			
		}else{
			echo "query error";
		}
	}

 ?>