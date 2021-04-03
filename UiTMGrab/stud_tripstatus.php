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
          <li class="nav-item">
            <a class="nav-link" href="stud_updateacc.php">Update Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stud_viewbooking.php">View All Bookings <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stud_placebooking.php">Place A Booking</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Bookings</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      <div class="container">


        <?php
        include('sql_connect.php');

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo "Hello, "  . $_SESSION['matrix'];
        }
        ?>

        <center><h1>Check Status of My Bookings<h1></center><br>
          <div class="row">
        <!-- Example row of columns -->
          <?php
            $student_matrix = $_SESSION['matrix'];
            $query = "SELECT `student_id` FROM `student` WHERE `student_matrix` = '$student_matrix'";
            $student = mysqli_query($con, $query);
            $row = mysqli_fetch_object($student);

            $sql = "select * from booking inner join student on booking.fk_student_id=student.student_id where fk_student_id='$row->student_id' order by booking_date desc";
            $query1=mysqli_query($con,$sql);
            if(mysqli_num_rows($query1)>0)
            {
                while($row=mysqli_fetch_object($query1))
                {
          ?>
          <div class="col-md-12" style="border: 2px solid #e3e3e3;border-radius: 20px; margin: 2px;">
            <h2>Booking ID: <?php echo $row->booking_id ?></h2>

            <h5><br>
              Name: <?php echo $row->student_name ?><br>
              Pick-up: <?php echo $row->booking_pickup ?><br>
              Drop-off: <?php echo $row->booking_drop ?><br>
              Date: <?php echo $row->booking_date ?><br>
              Time: <?php echo $row->booking_time ?><br>
              Status: <?php echo $row->booking_status ?><br>
              <br>
            </h5>

              </div>

            <?php
                }
            }
            ?>
        </div> <!-- /row -->
        <hr>
      </div> <!-- /container -->
    </main>

    <footer class="container">
      <center>&copy; UiTM Ride-Hailing System 2019</center>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
