


<?php 
	include_once 'connection.php'; 
?>

<?php    

  if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $remove = "DELETE FROM `category` WHERE `category_id`='$id'";
        mysqli_query($conn,$remove);

        if(mysqli_query($conn,$remove)){
            header('Location:ViewMainCategory.php');
        }

        else{
            echo "error..".mysqli_error($conn);
         }    

   }
        
  

  else{
    header('Location:ViewMainCategory.php');
  }

?>