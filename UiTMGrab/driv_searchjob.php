<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Search Bookings</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" charset="utf-8">
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
          <li class="nav-item active">
            <a class="nav-link" href="driv_viewjob.php">View All Jobs<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">My Jobs</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" name="form1" method="post" action="driv_searchjob.php">
          <input class="form-control mr-sm-2" name="txtSearch" type="text" placeholder="Search" aria-label="Search" id="txtSearch">
          <button class="btn btn-outline-success my-2 my-sm-0" name="Submit" type="submit" value="Search" >Search</button>
        </form>
      </div>
    </nav>

    <main role="main">
      <div class="container">

        <?php
        include 'sql_connect.php';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo "Hello, "  . $_SESSION['email'];
        }

        $search=$_REQUEST["txtSearch"];
        $query = "Select
        booking.booking_id, student.student_name, booking.booking_pickup, booking.booking_drop, booking.booking_date, booking.booking_time
        from booking
        inner join student
        on booking.fk_student_id=student.student_id
        where booking_pickup LIKE '%$search%'
        order by booking_id Asc";
        $result = mysqli_query( $con,$query) or die("Query failed");
        ?>

        <center><h1>Search Bookings By Pickup<h1></center><br>
          <div class="row">

        <?php
        $jumpa = 0;
        while($row = mysqli_fetch_array($result)){ $jumpa = 1;?>

        <div class="col-md-4" style="border: 2px solid #e3e3e3;border-radius: 20px; margin: 2px;">
        <h2>Booking ID: <?php echo $row['booking_id']; ?></h2>
        <h5>
          <br>Name: <?php echo $row['student_name']; ?>
          <br>Pick-up: <?php echo $row['booking_pickup'] ?>
          <br>Drop-off: <?php echo $row['booking_drop'] ?>
          <br>Date: <?php echo $row['booking_date'] ?>
          <br>Time: <?php echo $row['booking_time'] ?><br>
          <br><p><a class="btn btn-secondary" href="#" role="button">Take this job &raquo;</a></p>
        </h5>
      </div>

        <?php // looping close
        }?>

        <?php
        if($jumpa == 0)
        {
          echo "Pickup not found!";
        }?>

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
