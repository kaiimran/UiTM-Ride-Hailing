<?php
session_start();
require ('sql_connect.php');

$status = $_POST["status"];
$booking_id = $_POST["booking_id"];

$sql="UPDATE booking SET booking_status='$status' WHERE booking_id='$booking_id'";
$result = mysqli_query($con, $sql) or die("update failed");

if($result){
    echo $status;
}
?>
