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
  }else{
    header('Location:dashboard.php');
    //$job_position = "admin";
  }

?>


<?php 
  echo "<li id=\"dashboard\">
              <a href=\"dashboard.php\">
                <i class=\"nc-icon nc-tv-2\"></i>
                <p>Dashboard</p>
              </a>
            </li>";
            
  switch ($job_position) {

    case 'Admin':
      echo "<li id=\"ansm\">
            <a href=\"newuser.php\">
              <i class=\"nc-icon nc-simple-add\"></i>
              <p>Add New Staff Member</p>
            </a>
          </li>";
      echo "<li id=\"rul\">
            <a href=\"removeuserlist.php\">
              <i class=\"nc-icon nc-badge\"></i>
              <p>Remove User List</p>
            </a>
          </li>";

    case 'AB':

    case 'Head':
      
    case 'Warden':
      
    case 'Survay':
      
    
    case 'TO':
      echo "<li id=\"msm\">
            <a href=\"mangeuser.php\">
              <i class=\"nc-icon nc-badge\"></i>
              <p>Manage Staff Member</p>
            </a>
          </li>";

      echo "<li id=\"ms\">
            <a href=\"mangestudent.php\">
              <i class=\"nc-icon nc-badge\"></i>
              <p>Manage Student</p>
            </a>
          </li>";
      

    case 'student':
    
    case 'Assistant':
      
    case 'Lecture':
      
      echo "<li id=\"up\">
            <a href=\"userprofile.php\">
              <i class=\"nc-icon nc-badge\"></i>
              <p>User Profile</p>
            </a>
          </li>";
      break;
    
    default:
      
      break;
  }




 ?>

          
          
          
          
          
          

