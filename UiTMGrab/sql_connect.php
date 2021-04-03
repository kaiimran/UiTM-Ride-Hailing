
<?php
$con=mysqli_connect('localhost', 'root','') or die('Error Connect to DB');
mysqli_select_db($con,'uitmgrab') or die ('Error Select DB');

if(mysqli_select_db($con,'uitmgrab') > 0)
echo (" ");
?>
