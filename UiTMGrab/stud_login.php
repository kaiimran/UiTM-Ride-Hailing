<?php
require ('sql_connect.php');

if (isset($_POST['submit']))
{
  $matrix=$_POST['s_matrix'];
  $password=$_POST['s_pass'];

  $sql= mysqli_query($con,"SELECT * FROM `student` WHERE `student_matrix` = '$matrix' AND `student_pass` = '$password'");

  if(mysqli_num_rows($sql) > 0)
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='stud_viewbooking.php'
    </SCRIPT>");
    session_start();

			$_SESSION['loggedin'] = true;
			$_SESSION['matrix'] = $matrix;
			$_SESSION['password'] = $password;
			$_SESSION['stud'] = true;

			exit();
  }
  else
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Wrong email and password combination. Please re-enter.')
    window.location.href='stud_login.html'
    </SCRIPT>");
    exit();
  }
}
