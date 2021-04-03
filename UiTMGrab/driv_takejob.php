<?php
session_start();
require ('sql_connect.php');

$booking_id = $_GET['booking_id'];
$driver_email = $_SESSION['email'];

$query = "SELECT `driver_id` FROM `driver` WHERE `driver_email` = '$driver_email'";
$driver = mysqli_query($con, $query);
$row = mysqli_fetch_object($driver);

$query1 = "Update booking set fk_driver_id='$row->driver_id', booking_status = 'A driver has accepted your booking' where booking_id = '$booking_id'";
$result = mysqli_query($con, $query1) or die("query failed");

if($result)
{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('You just take a job. Please update the status accordingly.')
        window.location.href='driv_jobstatus.php'
        </SCRIPT>");
        exit();
}
else
{
  echo "Problem occured !";
  mysqli_close($con);
}

?>
