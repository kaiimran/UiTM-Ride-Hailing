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
            <a class="nav-link" href="driv_viewjob.php">View All Jobs<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Jobs</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" name="form1" method="post" action="driv_searchjob.php">
          <input class="form-control mr-sm-2" name="txtSearch" type="text" placeholder="Enter a pick-up location" aria-label="Search" id="txtSearch">
          <button class="btn btn-outline-success my-2 my-sm-0" name="Submit" type="submit" value="Search" >Search</button>
        </form>
      </div>
    </nav>

    <main role="main">
      <div class="container">


        <?php
        include('sql_connect.php');

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo "Hello, "  . $_SESSION['email'];
        }
        ?>

        <center><h1>My Jobs<h1></center><br>
          <div class="row">
        <!-- Example row of columns -->
          <?php
            $driver_email = $_SESSION['email'];
            $query = "SELECT `driver_id` FROM `driver` WHERE `driver_email` = '$driver_email'";
            $driver = mysqli_query($con, $query);
            $row = mysqli_fetch_object($driver);

            $sql = "select * from booking inner join student on booking.fk_student_id=student.student_id where fk_driver_id='$row->driver_id' order by booking_date desc";
            $query1 = mysqli_query($con,$sql);
            if(mysqli_num_rows($query1)>0)
            {
                while($row=mysqli_fetch_object($query1))
                {
          ?>
          <div class="col-md-12" style="border: 2px solid #e3e3e3;border-radius: 20px; margin: 5px;">
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
            <p>
              <button class="updateStatus btn <?php if($row->booking_status == 'On the way to pick up'){echo 'btn-primary';}else{echo 'btn-secondary';} ?>"
                data-bookingid="<?php echo $row->booking_id ?>"
                data-status="On the way to pick up">
                &raquo; On the way to pick up
              </button>

              <button class="updateStatus btn <?php if($row->booking_status == 'In transit to destination'){echo 'btn-primary';}else{echo 'btn-secondary';} ?>"
                data-bookingid="<?php echo $row->booking_id ?>"
                data-status="In transit to destination">
                &raquo; In transit to destination
              </button>

              <button class="updateStatus btn <?php if($row->booking_status == 'Arrived at the destination'){echo 'btn-primary';}else{echo 'btn-secondary';} ?>"
                data-bookingid="<?php echo $row->booking_id ?>"
                data-status="Arrived at the destination">
                &raquo; Arrived at the destination
              </button>
            </p>

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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){

        $(".updateStatus").click(function (e) {
            e.preventDefault();
            var booking_id = $(this).attr("data-bookingid");
            var status = $(this).attr("data-status");
            $.ajax({
                url:'driv_updatestatus.php',
                method:'POST',
                data:{
                    booking_id:booking_id,
                    status:status
                },
                success:function(response){
                    alert('Status updated to: ' + response);
                    window.location.reload();
                }
            });
        });

      });
    </script>
  </body>
</html>
