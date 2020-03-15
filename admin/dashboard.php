<?php session_start() ?>

<?php 

  if(!isset($_SESSION['admin'])){
    header('location: login.php');
  }


  include("config/db_connect.php");

  /*write query for all images*/
  //$sql = "SELECT id,fullname,type,day,timee,payment_method,created_at FROM bookings ORDER BY id DESC";
  $sql = "SELECT * FROM bookings ORDER BY id DESC";



  /*make query and get results*/
  $result = mysqli_query($conn, $sql);

  /*fetch resulting rows as an array*/
  $bookers = mysqli_fetch_all($result, MYSQLI_ASSOC);


  /*freeing results from memory*/
  // mysqli_free_result($result);

  /*close connection to database*/
  // mysqli_close($conn);

  //geting number of signups


  //getting current number of Allowed Bookings
  $sql2 = "SELECT * FROM admin_settings";
  $result2 = mysqli_query($conn,$sql2);
  $adminSettingsData = mysqli_fetch_assoc($result2);
  $_SESSION['allowed_seats'] = $adminSettingsData['total_seats'];


  //getting number of signups
  $sql3 = "SELECT * FROM user WHERE verified=0";
  $sql4 = "SELECT * FROM user WHERE verified=1";
  $result3 = mysqli_query($conn,$sql3);
  $result4 = mysqli_query($conn,$sql4);

  $_SESSION['num_of_unverified'] = mysqli_num_rows($result3);
  $_SESSION['num_of_verified'] = mysqli_num_rows($result4);
  $_SESSION['total_signups'] = $_SESSION['num_of_verified'] + $_SESSION['num_of_unverified'];

  //changing number of allowed bookings
  if(isset($_POST['changeBookingNum'])){
    $newNum = $_POST['numAllowedBookings'];
    $sql = "UPDATE admin_settings SET total_seats='$newNum' WHERE id=1";


    if(mysqli_query($conn,$sql)){
      $_SESSION['allowed_seats'] = $newNum;
      echo "<script>alert('Number of Allowed Bookings Altered')</script>";
    }
  }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin Dashboard</title>
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <link rel="stylesheet" href="../fontawesome/css/all.min.css" type="text/css">
  <!-- Bootstrap core CSS -->
  <!-- <link href="../mdb/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Material Design Bootstrap -->
  <!-- <link href="../mdb/css/mdb.min.css" rel="stylesheet"> -->
  <!-- Your custom styles (optional) -->
  <link href="css/dashboard.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <!-- <link rel="icon" type="image/ico" href="img/favicon.ico"/> -->
</head>
<style type="text/css">
  #insights{
    /*width: 100%;*/
  }

  #insights > div{
    width: 70%;
    padding: 1rem;
    margin: 1rem auto;
    box-shadow: 0.1rem 0.1rem 0.3rem 0.1rem rgba(0,0,0,0.2);
    border-radius: 0.5rem;
    text-transform: uppercase;
    /*margin-right: 1rem;*/
  }

  #insights > div span{
    font-size: 5rem;
    margin-right: 1rem;
  }

</style>
<body>

  <header>
    <i class="fas fa-bus"></i>
    <span><?php echo $_SESSION['admin']; ?></span>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
  </header>

  <main>
    <div id="bookings">
     <div>
      <?php if(empty($bookers)): ?>
        <h2 style="text-align: center;">Zero Bookings</h2>
      <?php else: ?>
        <?php foreach ($bookers as $booker): ?>
          <div>
            <h2><?php echo htmlspecialchars($booker['fullname']) ?></h2>
            <span>Type: </span><span><?php echo htmlspecialchars($booker['type']) ?></span><br>
            <span>Day: </span><span><?php echo htmlspecialchars($booker['day']) ?></span><br>
            <span>Time: </span><span><?php echo htmlspecialchars($booker['timee']) ?></span><br>
            <span>Location: </span><span><?php echo htmlspecialchars($booker['location']) ?></span><br>
            <span>Payment Method: </span><span><?php echo htmlspecialchars($booker['payment_method']) ?></span><br>
           <span style="display: inline-block; padding: 0.2rem; background-color: orangered; color: white">Revoke Booking</span>
          </div>
        <?php endforeach ?>
      <?php endif ?>
     </div>
    </div>
    <div id="feedback">feedback from users appear here</div>
    <div id="settings">
     <!--  basic settings like closing/allowing bookings, altering max number of allowed bookings, remove a user from database etc -->
      <form method="POST" action="dashboard.php" style="width: 90%; margin: 0 auto;display: flex; flex-flow: column">
        <p style="margin: 0 auto; padding: 1rem">Current allow booking is <?php echo  $_SESSION['allowed_seats'] ?></p>
        <input type="number" placeholder="Allowed Bookings" name="numAllowedBookings" required style="width: 10rem; padding: 0.7rem;margin: 1rem auto">
        <button type="submit" name="changeBookingNum" style="background-color: #0072b1; outline: none; padding: 0.7rem; border: none;color: white; width: 10rem; margin: 0.5rem auto">Alter Booking Number</button>
      </form>
    </div>
    <div id="insights">
      <!-- number of people signed up
      charts/graphs -- most booked time/day, highest booking ever recorded etc -- any data to help us analyze the service -->
        <div><span><?php echo $_SESSION['total_signups']; ?></span>SIGNUPS</div>
        <div><span><?php echo $_SESSION['num_of_verified']; ?></span>verified</div>
        <div><span><?php echo $_SESSION['num_of_unverified']; ?></span>unverified</div>

    </div>
    <div id="news">
      General Information to the public about anything regarding the service
      -- could be discounts, a break in operation etc
    </div>
    <p class="loader"></p>
  </main>

  <nav>
    <a href="#bookings" class="clicked"><i class="fas fa-bus"></i></a>
    <a href="#feedback"><i class="fas fa-comment"></i></a>
    <a href="#settings"><i class="fas fa-cog"></i></a>
    <a href="#insights"><i class="fas fa-chart-bar"></i></a>
    <a href="#news"><i class="fas fa-bullhorn"></i></i></a>
  </nav>


</body>
</html>


<script src="js/dashboard.js"></script>