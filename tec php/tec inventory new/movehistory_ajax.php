<?php require_once('connection.php'); ?>
<?php require_once('external.php'); ?>
<?php

	if (isset($_SESSION['department_id'])) {
		$user_department=$_SESSION['department_id'];
	}else{
		header('Location:index.php');
	}

	$show="error";
	$query = "SELECT * FROM move WHERE (current_department='{$user_department}' OR move_department='{$user_department}') AND status IS NOT NULL";
	if (isset($_POST['department'])) {
		if ($_POST['department']!="0") {
			$query.=" AND current_department='{$_POST['department']}'";
		}
	}
	if (isset($_POST['search'])) {
		$query.=" AND current_department LIKE '%{$_POST['search']}%'";
	}
    $result = mysqli_query($conn,$query);
    if ($result) {
      if (mysqli_num_rows($result)>0) {
        while ($detail = mysqli_fetch_assoc($result)) {
          $show.= "<tr>";
            $show.= "<td>";
              $show.= $detail['move_id'];
            $show.= "</td>";
            $show.=  "<td>";
              $show.= $detail['item_name'];        
            $show.= "</td>";
            $show.="<td>";
              $show.= $detail['current_department'];         
            $show.="</td>";
            $show.="<td>";
               $show.= $detail['request_date'];     
            $show.="</td>";
            $show.="<td>";
              $show.= $detail['return_date'];
            $show.="</td>";
              $show.="<td>";
                $show.= $detail['move_type'];       
             $show.= "</td>";
             $show.= "<td>";
                $show.= $detail['move_department'];       
              $show.= "</td>";
              $show.= "<td>";
                   $show.= $detail['status'];      
              $show.= "</td>";
         $show.=" </tr>";
         
        }
      }else{
    	$show="no result";
      }
    }else{
    	$show="error";
    }

    echo $show;
?>