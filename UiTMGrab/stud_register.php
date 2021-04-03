<?php
	include('sql_connect.php');
	$error = "";
	$student_id = "0";
	$name = "";
	$matrix = "";
	$IC = "";
	$password = "";
  $phone = "";
  $college = "";

	if(isset($_POST['btnsave']))
	{
    $name = $_POST['name'];
  	$matrix = $_POST['matrix'];
  	$IC = $_POST['IC'];
  	$password = $_POST['password'];
    $phone = $_POST['phone'];
    $college = $_POST['college'];

    if(strlen($matrix) != 10 )
    {
      $error = "Matrix number must have 10 numbers.";
      echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('Matrix number must have 10 numbers.')
              window.location.href='stud_register.html'
              </SCRIPT>");
    }
		else if(strlen($IC) != 12)
		{
			$error = "IC must have 12 numbers.";
			echo ("<SCRIPT LANGUAGE='JavaScript'>
           		 window.alert('IC must have 12 numbers.')
            	window.location.href='stud_register.html'
            	</SCRIPT>");
		}
		else if(strlen($password) < 6)
		{
			$error = "Password must be at least more than 5 characters.";
			echo ("<SCRIPT LANGUAGE='JavaScript'>
           		 window.alert('Password must be at least more than 5 characters.')
            	window.location.href='stud_register.html'
            	</SCRIPT>");
		}
		else
		{

			if($_POST['txtid'] == "0")
			{
				//add new student
				$sql = "insert into student(student_name, student_matrix, student_ic, student_pass, student_phone, student_college) values ('$name', '$matrix', '$IC', '$password', '$phone', '$college')";
				$query = mysqli_query($con,$sql);

				echo ("<SCRIPT LANGUAGE='JavaScript'>
           		 window.alert('Sucessfully registered. Please login.')
            	window.location.href='stud_login.html'
            	</SCRIPT>");

            	exit();

			}
		}
	}
