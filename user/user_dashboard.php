<?php session_start() ?>
<?php 
  
  //preventing user access to dashbaord if not logged in
  if(!isset($_SESSION['user']) or !isset($_SESSION['verified'])){
    header('location: user_signin.php');
  }else{
    include '../admin/config/db_connect.php';
    //getting admin specified number of seats to take
    $sql2 = "SELECT * FROM admin_settings WHERE id=1";
    $result2 = mysqli_query($conn,$sql2);
    $total_seats = mysqli_fetch_assoc($result2)['total_seats'];

    //getting number of seats taken from the bookings table to show on user dashboard
    $sql1 = "SELECT * FROM bookings";
    $result1 = mysqli_query($conn,$sql1);
    $seats_taken = mysqli_num_rows($result1);


    $_SESSION['seatsAvailable'] = $total_seats - $seats_taken;
  }

  //getting number of seats available
 

 
  //cancelling a booking
  if(isset($_GET['cancel'])){
    include '../admin/config/db_connect.php';
    $user = $_SESSION['user'];

    $sql = "DELETE FROM bookings WHERE fullname='$user'";
    $result = mysqli_query($conn,$sql);

    if($result){
      $_SESSION['booked'] = false;
      $_SESSION['seatsAvailable'] += 1; //increase seats available
      echo "<script>alert('booking is canceled')</script>";
    }else{
      echo "<script>alert('booking failed')</script>";
    }
  }



  //booking a seat
  if(isset($_GET['book'])){
    if(!empty($_GET['type']) or !empty($_GET['location']) or !empty($_GET['day']) or !empty($_GET['time']) or !empty($_GET['payment_method'] or !empty($_GET['price']))){
      include '../admin/config/db_connect.php';
      $fullname = mysqli_real_escape_string($conn,$_SESSION['user']);

      $sql = "SELECT * FROM bookings WHERE fullname='$fullname'";
      $result = mysqli_query($conn,$sql);
      $data = mysqli_num_rows($result);

      //checking if user is already booked
      if($data > 0){
        echo "<script>alert('you are already booked')</script>";
      }else{
        $type = mysqli_real_escape_string($conn,$_GET['type']);
        $location = mysqli_real_escape_string($conn,$_GET['location']);
        $day = mysqli_real_escape_string($conn,$_GET['day']);
        $time = mysqli_real_escape_string($conn,$_GET['time']);
        $payment_method = mysqli_real_escape_string($conn,$_GET['payment_method']);
        $price = mysqli_real_escape_string($conn,$_GET['price']);

        $sql = "INSERT INTO bookings(fullname,location,type,day,timee,payment_method,price) VALUES('$fullname','$location','$type','$day','$time','$payment_method','$price')";

        if(mysqli_query($conn,$sql)){
          $_SESSION['booked'] = true;
          $_SESSION['seatsAvailable'] -= 1; //reduce seats available
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
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <!-- <link rel="icon" type="image/ico" href="img/favicon.ico"/> -->
</head>
<style type="text/css">
  *{
    font-family: 'Roboto', sans-serif;
  }



</style>
<body>

  
  <!-- if user is verified, show dashboard else show email verification prompt -->
  <?php if(isset($_SESSION['verified']) and $_SESSION['verified'] === '1'): ?>
    <header>
      <i class="fas fa-bus"></i>
      <span><?php echo $_SESSION['user']; ?></span>
      <a href="user_logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </header>

    <main>
      <div id="bookings">
        <!-- if all seats are taken, display a sorry statement
        else if user is booked, show a cancel booking button 
        else show booking form -->
        <?php if($_SESSION['seatsAvailable'] < 1): ?>
            <h2 style="color: #923d30;padding: 0.8rem; width: 70%; text-align:center;margin: 40vh auto;font-family: sans-serif;">Sorry, booking is closed</h2>
        <?php elseif($_SESSION['booked'] === true): ?>
          <form method="GET" action="user_dashboard.php">
            <button style="background-color: #923d30; color: white;padding: 0.8rem; width: 70%; text-align:center;margin: 40vh auto; cursor: pointer" name="cancel" value="<?php echo $_SESSION['user'] ?>">Cancel Booking</button>
          </form>
        <?php else: ?>
         <form method="GET" action="user_dashboard.php">
            <!-- <h2 style="text-align: center;">Book a Seat</h2> -->
            <h3><?php echo $_SESSION['seatsAvailable']; ?> Seats left to book</h3>

           <select name="type" required>
             <option disabled selected hidden>Type</option>
             <option>From Ashesi</option>
             <option>To Ashesi</option>
           </select>

           <select name="location" required>
             <option disabled selected hidden>Location</option>
             <option value="Kwabenya">Kwabenya - 12 GHC</option>
             <option value="Accra Mall">Accra Mall - 30 GHC</option>
             <option value="Madina">Madina - 25 GHC</option>
             <option value="Legon">Legon - 30 GHC</option>
             <option value="Palace">Palace - 35 GHC</option>
             <option value="Cantonments">Cantonments - 45 GHC</option>
           </select>

           <select name="day" required>
             <!-- From Ashesi -->
             <option disabled selected hidden>Day</option>
             <option>Friday</option>
             <option>Saturday</option>
             <option>Sunday</option>
           </select>

           <select name="time" required>
             <option disabled selected hidden>Time</option>
           </select>
      
           <select name="payment_method" required >
             <option disabled selected hidden>Payment Method</option>
             <option>MoMo</option>
             <option>Cash</option>
           </select>

           <input type="text" name="price" placeholder="Price" required hidden>
      
           <button type="submit" name="book">book</button>
         </form>
        <?php endif ?>
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