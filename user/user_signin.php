<?php session_start() ?>

<?php 

  $prompt = "";

  if(isset($_POST['signin'])){
    include '../admin/config/db_connect.php';

    //if any of the fields is empty, prompt user
    if(empty($_POST['email_or_username']) or empty($_POST['password'])){
      $prompt = "please fill all fields";
    }
    else{
      $email_or_username = mysqli_real_escape_string($conn,$_POST['email_or_username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

      $sql = "SELECT * FROM user WHERE email='$email_or_username' OR fullname='$email_or_username'";
      $result = mysqli_query($conn,$sql);
      $data = mysqli_num_rows($result);

      if($data < 1 ){
        $prompt = "invalid username or password";
      }
      else{
        if($row = mysqli_fetch_assoc($result)){
          $hashed_password = password_verify($password,$row['password']);

          if(!$hashed_password){
            $prompt = "invalid email or password";
          }
          elseif($hashed_password){
            $_SESSION['user'] = $row['fullname'];
            $_SESSION['verified'] = $row['verified'];
            header('location: user_dashboard.php#bookings');
          }
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
  <title>EasyGo - User</title>
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <!-- <link rel="stylesheet" href="../fontawesome/css/all.min.css" type="text/css"> -->
  <!-- Bootstrap core CSS -->
  <!-- <link href="../mdb/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Material Design Bootstrap -->
  <!-- <link href="../mdb/css/mdb.min.css" rel="stylesheet"> -->
  <!-- Your custom styles (optional) -->
  <link href="css/user_signin.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <!-- <link rel="icon" type="image/ico" href="img/favicon.ico"/> -->
</head>
<body>

  <!-- Default form login -->
  <form method="POST" action="user_signin.php">

      <p>easy go</p>

      <div>
        <!-- Email -->
        <input type="text" name="email_or_username" placeholder="E-mail or Username">

        <!-- Password -->
        <input type="password" name="password" placeholder="Password">


        <span class="error-text"><?php echo $prompt; ?></span>

        <!-- Remember me and Forgot Password-->
        <div>
          <div>
            <input type="checkbox" id="remember-me">
            <label for="remember-me">Remember me</label>
          </div>

          <!-- Forgot password -->
          <a href="" id="forgot-password" style="color: #923d30">Forgot password?</a> 

        </div>

        <!-- Sign in button -->
        <button type="submit" name="signin">Sign in</button>

        <!-- Dont have an account? -->
        <div>
          <span>Not a member? <a href="user_signup.php">Sign Up</a></span>
        </div>

      </div>
  </form>
   
</body>
</html>