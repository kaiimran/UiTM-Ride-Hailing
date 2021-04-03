<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    /* Move down content because we have a fixed navbar that is 3.5rem tall */
    body {
      padding-top: 5.5rem;
    }

    .col-md-4{-ms-flex:0 0 32%;flex:0 0 32%;max-width:32%}

    #input-area {
      margin-top: 40px;
    }

    .f-inp {
      padding: 11px 25px;
      border: 1px solid #e3e3e3;
      line-height: 1;
      border-radius: 20px;
    }

    .f-inp input {
      width: 100%;
      font-size: 13.4px;
      padding: 0;
      margin: 0;
      border: 0;
    }

    .f-inp input::placeholder {
      color: #777;
    }

    #submit-button {
      display: block;
      width: 100%;
      color: #fff;
      font-size: 14px;
      margin: 0;
      padding: 14px 13px 12px 13px;
      border: 0;
      background-color: green;
      border-radius: 25px;
      line-height: 1;
      cursor: pointer;
    }

    #submit-button-cvr {
      margin-top: 20px;
    }
  </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="logout.php">Logout</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="stud_viewacc.php">Update Account <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stud_viewbooking.php">View All Bookings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stud_placebooking.php">Place A Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stud_tripstatus.php">My Bookings</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
              echo "Hello, "  . $_SESSION['matrix'];
            }
    ?>

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
  	$matrix = $_SESSION['matrix'];
  	$IC = $_POST['IC'];
  	$password = $_POST['password'];
    $phone = $_POST['phone'];
    $college = $_POST['college'];

    if(strlen($IC) != 12)
    {
      $error = "IC must have 12 numbers.";
      echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('IC must have 12 numbers.')
              window.location.href='stud_updateacc.php'
              </SCRIPT>");
    }

    if(strlen($password) < 6)
    {
      $error = "Password must be at least more than 5 characters.";
      echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('Password must be at least more than 5 characters.')
              window.location.href='stud_updateacc.php'
              </SCRIPT>");
    }

    if($phone == "")
    {
      $error = "Phone number is empty.";
      echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('Phone number is empty.')
              window.location.href='stud_updateacc.php'
              </SCRIPT>");
    }

    if($college == "")
    {
      $error = "College name is empty.";
      echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('College name is empty.')
              window.location.href='stud_updateacc.php'
              </SCRIPT>");
    }

    else
    {
        $sql = "Update student set student_name='$name', student_matrix = '$matrix', student_ic = '$IC', student_pass='$password', student_phone = '$phone', student_college = '$college' where student_matrix = '$matrix'";
        $query = mysqli_query($con,$sql);
        if($query)
        {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.alert('Successfully edited.')
          window.location.href='#'
          </SCRIPT>");
        }
      }
    }
?>

<?php
//tak berfungsi
    $matrix = $_SESSION['matrix'];
    $sql="select * from `student` where `student_matrix` = '$matrix'";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_object($query);
    $student_id = $row->student_id;
    $name = $row->student_name;
    $IC = $row->student_ic;
    $password = $row->student_pass;
    $phone = $row->student_phone;
    $college = $row->student_college;
?>
      <form action="" method="post">
      <center><h1>Update Account Information<h1></center>
      <input type="hidden" name="txtid" value="<?php echo $student_id; ?>" />
      <div id="input-area">
        <div class="f-inp">
          <input type="text" placeholder="Name" name="name" value = "<?php echo $name; ?>">
        </div>
        <br>
        <div class="f-inp">
          <input type="text" placeholder="IC Number" name="IC" value = "<?php echo $IC; ?>">
        </div>
        <br>
        <div class="f-inp">
          <input type="password" placeholder="Password" name="password" value = "<?php echo $password; ?>">
        </div>
        <br>
        <div class="f-inp">
          <input type="text" placeholder="Phone Number" name="phone" value = "<?php echo $phone; ?>">
        </div>
        <br>
        <div class="f-inp">
          <input type="text" placeholder="College Name" name="college" value = "<?php echo $college; ?>">
        </div>
      </div>
      <div id="submit-button-cvr">
        <button type="submit" name="btnsave" id="submit-button">SAVE</button>
      </div>
      <br>
    </form>

    <form action="delete.php?id=<?php print ($_SESSION['matrix']);?>" method="post">
    <div id="submit-button-cvr">
      <button type="submit" name="btndelete" id="submit-button" style="background-color: red">DELETE ACCOUNT PERMANENTLY</button>
    </div>
    </form>

    </main>

    <footer class="container">
      <center>&copy; UiTM Ride-Hailing System 2019</center>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
