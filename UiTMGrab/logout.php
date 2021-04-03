<title>Logging out...</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
	session_start();

	$_SESSION['loggedin'] = false;


	session_unset();

	session_destroy();

	echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Sucessfully logout.')
			window.location.href='index.html'
			</SCRIPT>");

	exit();
?>
