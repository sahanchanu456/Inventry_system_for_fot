<?PHP include '../connection.php';?>

<?php

$cp_data="INSERT surver_data SELECT * FROM surver_data_tempory";
mysqli_query($conn,$cp_data);

$remove_data="DELETE FROM surver_data_tempory";
mysqli_query($conn,$remove_data);

header('Location:../dashboard.php');

?>