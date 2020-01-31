<?php session_start() ?>

<?php 

  if(!isset($_SESSION['user'])){
    header('location: user_signin.php');
  }



  if(isset($_POST['book'])){
      // echo "<script>alert('it works like magiccc')</script>";
    if(!empty($_POST['type']) or !empty($_POST['day']) or !empty($_POST['time']) or !empty($_POST['payment_method'])){
      include '../admin/config/db_connect.php';

      $fullname = $_SESSION['user'];

      $sql = "SELECT * FROM bookings WHERE fullname='$fullname'";
      $result = mysqli_query($conn,$sql);
      $data = mysqli_num_rows($result);

      //checking if user is already booked
      if($data > 0){
        echo "<script>alert('you are already booked')</script>";
      }else{
        $type = mysqli_real_escape_string($conn,$_POST['type']);
        $day = mysqli_real_escape_string($conn,$_POST['day']);
        $time = mysqli_real_escape_string($conn,$_POST['time']);
        $payment_method = mysqli_real_escape_string($conn,$_POST['payment_method']);

        $sql = "INSERT INTO bookings(fullname,type,day,timee,payment_method) VALUES('$fullname','$type','$day','$time','$payment_method')";

        if(mysqli_query($conn,$sql)){
          echo "<script>alert('booking is recorded')</script>";
        }
      }

    } 
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>User Dasboard</title>
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <link rel="stylesheet" href="../fontawesome/css/all.min.css" type="text/css">
  <!-- Bootstrap core CSS -->
  <!-- <link href="../mdb/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Material Design Bootstrap -->
  <!-- <link href="../mdb/css/mdb.min.css" rel="stylesheet"> -->
  <!-- Your custom styles (optional) -->
  <link href="css/user_dashboard.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <!-- <link rel="icon" type="image/ico" href="img/favicon.ico"/> -->
</head>
<style type="text/css">


</style>
<body>
  
  <?php if(isset($_SESSION['verified']) and $_SESSION['verified'] === '1'): ?>
    <header>
      <i class="fas fa-bus"></i>
      <span><?php echo $_SESSION['user']; ?></span>
      <a href="user_logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </header>

    <main>
      <div id="bookings">
       <form method="POST" action="user_dashboard.php">
          <h3>Book a Seat</h3>
         <select name="type">
           <option disabled selected hidden>Type</option>
           <option>Leaving Campus</option>
           <option>Returning to Campus</option>
         </select>

         <select name="day">
           <option disabled selected hidden>Select Day</option>
           <option>Monday</option>
           <option>Tuesday</option>
           <option>Wednesday</option>
           <option>Thursday</option>
           <option>Friday</option>
           <option>Saturday</option>
           <option>Sunday</option>
         </select>

         <select name="time">
           <option disabled selected hidden>Select Time</option>
           <option>1pm</option>
           <option>2pm</option>
           <option>2pm</option>
         </select>

         <select name="payment_method">
           <option disabled selected hidden>Payment Method</option>
           <option>MoMo</option>
           <option>Cash</option>
         </select>

         <button type="submit" name="book">book</button>
       </form>
      </div>

      <div id="feedback">
        <form>
          <h3>You got something to tell us?</h3>
          <textarea rows="10"></textarea>
          <button>send message</button>
        </form>
      </div>

      <div id="settings">
        ABILITY TO DELETE YOUR DATA/ACCOUNT AND OTHER STUFF
      </div>
      <div id="insights">
        INSIGHTS APPEAR HERE
      </div>
      <div id="news">
        INFORMATION FROM ADMINS APPEAR HERE
      </div>
      <p class="loader"></p>
    </main>

    <nav>
      <a href="#bookings"><i class="fas fa-bus"></i></a>
      <a href="#feedback"><i class="fas fa-comment"></i></a>
      <a href="#settings"><i class="fas fa-cog"></i></a>
      <a href="#insights"><i class="fas fa-chart-bar"></i></a>
      <a href="#news"><i class="fas fa-bullhorn"></i></a>
    </nav>
  <?php else: ?>
    <div style="width: 100vw; height: 100vh; display: flex; justify-content: center; align-items: center; background-color: #923d30">
        <div style="box-shadow: 0.005rem 0.005rem 0.3rem 0.1rem rgba(13,12,14,0.4)">
          <p style="text-align: center;color: white;padding: 1rem; font-family: sans-serif;font-size: 1.5rem;text-transform: capitalize;">Welcome <?php echo $_SESSION['user']; ?></p>
          <p style="background-color: white; padding: 1rem">Please activate your account via the link we just sent to your email address</p>
          <a href="user_logout.php" style="color: white;display: inline-flex;padding: 1rem; font-size: 1.2rem; text-decoration: none">Logout</a>
        </div>
    </div>
  <?php endif ?>




</body>
</html>


<script src="js/user_dashboard.js"></script>