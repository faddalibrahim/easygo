<?php 
  include 'config/db_connect.php';

  $errors = array('fullname'=>'', 'email'=>'','password'=>'','confirm_password'=>'');
  $fullname = $email = $password = $confirm_password = "";
  $prompt = "";

  if(isset($_POST['signup'])){

    //if any fields are empty, prompt the user
    if(empty($_POST['fullname']) or empty($_POST['email']) or empty($_POST['password']) or empty($_POST['confirm_password'])){
      $prompt = "please fill all fields";
    }else{

        $fullname = $_POST['fullname'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $fullname)){
          $errors['fullname'] = "fullname must be letters and spaces only";
        }

        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = "email must be a valid email address";
        }
      
        $password = $_POST['password'];
        if(!preg_match('/^[^\s]{8,}$/', $password)){
          $errors['password'] = "password must be 8+ characters long";
        }

        $confirm_password = $_POST['confirm_password'];
        if($confirm_password != $password){
          $errors['confirm_password'] = "passwords don't match";
        }

        if(!array_filter($errors)){
          //checking if user name and email already exit in database
          $sql1 = "SELECT * FROM admin WHERE fullname='$fullname'";
          $result1 = mysqli_query($conn, $sql1);
          $data1 = mysqli_num_rows($result1);

          $sql2 = "SELECT * FROM admin WHERE email='$email'";
          $result2 = mysqli_query($conn, $sql2);
          $data2 = mysqli_num_rows($result2);

          if($data1 > 0){
            $prompt = "username already exists";
          }else if($data2 > 0){
            $prompt = "email already exists";
          }else{
            //getting user input data from post
            $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);

            //hashing password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            //inserting user data into database
            $sql = "INSERT INTO admin(fullname,email,password) VALUES('$fullname','$email','$password_hashed')";
            if(mysqli_query($conn,$sql)){
              header('location: login.php');
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
  <title>EasyGo - Admin</title>
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <link rel="stylesheet" href="../fontawesome/css/all.min.css" type="text/css">
  <!-- Bootstrap core CSS -->
  <!-- <link href="../mdb/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Material Design Bootstrap -->
  <!-- <link href="../mdb/css/mdb.min.css" rel="stylesheet"> -->
  <!-- Your custom styles (optional) -->
  <link href="css/signup.css" rel="stylesheet">
  <!--Favicon-->
  <!-- <link rel="shortcut icon" type="image/png" href="img/favicon.png"/> -->
  <!-- <link rel="icon" type="image/ico" href="img/favicon.ico"/> -->
</head>


<style type="text/css">

  
</style>

<body>

  <!-- Default form login -->
  <form method="POST" action="signup.php">

      <p>Admin Sign Up</p>

      <div>
        <!-- Fullname -->
        <input type="text" name="fullname" placeholder="Fullname" value="<?php echo htmlspecialchars($fullname) ?>">
        <span class="error-text"><?php echo $errors['fullname']; ?></span>

        <!-- Email -->
        <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email) ?>">
        <span class="error-text"><?php echo $errors['email']; ?></span>

        <!-- Password -->
        <input type="password" name="password" placeholder="Password">
        <span class="error-text"><?php echo $errors['password']; ?></span>

        <!-- Confirm Password -->
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <span class="error-text"><?php echo $errors['confirm_password']; ?></span>

        <!-- Sign in button -->
        <button type="submit" name="signup"><i class="fas fa-sign-in-alt"></i>Sign up</button>

         <span class="error-text"><?php echo $prompt; ?></span>
      </div>
  </form>
   
</body>
</html>