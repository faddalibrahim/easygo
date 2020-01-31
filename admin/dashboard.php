<?php session_start() ?>

<?php 

  if(!isset($_SESSION['admin'])){
    header('location: login.php');
  }


  include("config/db_connect.php");

  /*write query for all images*/
  $sql = "SELECT id,fullname,type,day,timee,payment_method,created_at FROM bookings ORDER BY id DESC";

  /*make query and get results*/
  $result = mysqli_query($conn, $sql);

  /*fetch resulting rows as an array*/
  $bookers = mysqli_fetch_all($result, MYSQLI_ASSOC);

  /*freeing results from memory*/
  mysqli_free_result($result);

  /*close connection to database*/
  mysqli_close($conn);

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
      <?php foreach ($bookers as $booker): ?>
        <div>
          <h2><?php echo htmlspecialchars($booker['fullname']) ?></h2>
          <span>Type: </span><span><?php echo htmlspecialchars($booker['type']) ?></span><br>
          <span>Day: </span><span><?php echo htmlspecialchars($booker['day']) ?></span><br>
          <span>Time: </span><span><?php echo htmlspecialchars($booker['timee']) ?></span><br>
          <span>Payment Method: </span><span><?php echo htmlspecialchars($booker['payment_method']) ?></span><br>
         <span style="display: inline-block; padding: 0.2rem; background-color: orangered; color: white">Revoke Booking</span>
        </div>
      <?php endforeach ?>

     </div>
    </div>
    <div id="feedback">feedback from users appear here</div>
    <div id="settings">
      basic settings like closing/allowing bookings, altering max number of allowed bookings, remove a user from database etc
    </div>
    <div id="insights">
      number of people signed up
      charts/graphs -- most booked time/day, highest booking ever recorded etc -- any data to help us analyze the service
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