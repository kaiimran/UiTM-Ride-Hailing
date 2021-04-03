<?php
  session_start();
?>

<?php
require ('sql_connect.php');

$delete_id=$_GET['id'];

// Delete this account's booking first because it has foreign key
$query = "DELETE FROM booking WHERE fk_student_id IN (SELECT `student_id` FROM `student` WHERE `student_matrix` = '$delete_id')";
$result = mysqli_query($con, $query) or die("query failed");

// Then delete account
$query1 = "DELETE FROM student WHERE student_matrix='$delete_id'";
$result1 = mysqli_query($con, $query1) or die("query failed");

if($result1)
{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('Your account is permanently deleted')
        window.location.href='index.html'
        </SCRIPT>");
        exit();
}
else
{
  echo "Problem occured !";
  mysqli_close($con);
}

?>
