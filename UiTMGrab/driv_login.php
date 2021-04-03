<?php
require ('sql_connect.php');

if (isset($_POST['submit']))
{
  $email=$_POST['d_email'];
  $password=$_POST['d_pass'];

  if (!$_POST['d_email'] | !$_POST['d_pass'])
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('You did not complete all of the required fields')
    window.location.href='driv_login.html'
    </SCRIPT>");
  exit();
  }

  $sql= mysqli_query($con,"SELECT * FROM `driver` WHERE `driver_email` = '$email' AND `driver_pass` = '$password'");

  if(mysqli_num_rows($sql) > 0)
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='driv_viewjob.php'
    </SCRIPT>");
    session_start();

			$_SESSION['loggedin'] = true;
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			$_SESSION['stud'] = false;

			exit();
  }
  else
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Wrong email and password combination. Please re-enter.')
    window.location.href='driv_login.html'
    </SCRIPT>");
    exit();
  }
}
?>
