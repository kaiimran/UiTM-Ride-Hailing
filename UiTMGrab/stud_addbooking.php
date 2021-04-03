<?php
  session_start();
?>

<?php
  include('sql_connect.php');
  $matrix = "";
  $pickup = "";
  $dropoff = "";
  $status = "Searching for a driver";

  if(isset($_POST['btnPlace']))
  {
      $matrix = $_SESSION['matrix'];
      $pickup = $_POST['booking_pickup'];
      $dropoff = $_POST['booking_dropoff'];
      $date = (new DateTime($_POST['date']))->format('Y-m-d');
      $time = $_POST['time'] . ':00';
      $query1 = "SELECT `student_id` FROM `student` WHERE `student_matrix` = '$matrix'";
      $sql1= mysqli_query($con,$query1);
      $row = mysqli_fetch_object($sql1);
      $sql = "insert into `booking` (`fk_student_id`, `booking_date`, `booking_time`, `booking_pickup`, `booking_drop`, `booking_status`) values ('$row->student_id', '$date', '$time', '$pickup', '$dropoff', '$status')";
      $query = mysqli_query($con,$sql);

      if($query)
      {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
               window.alert('Booking Sucessfully Placed')
              window.location.href='stud_viewbooking.php'
              </SCRIPT>");
      }
      else
      {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Booking is not successful. Something went wrong.')
              </SCRIPT>");
      }
      exit();
  }
?>
