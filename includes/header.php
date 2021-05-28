<?php
require 'config/config.php';
if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query(
    $con,
    "SELECT * FROM users WHERE username='$userLoggedIn'"
  );
  $user = mysqli_fetch_array($user_details_query);
} else {
  header('Location: register.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        />
  <link rel="stylesheet" href="assets/styles/bootstrap.css">
  <link rel="stylesheet" href="assets/styles/style.css">
  <title>You are not alone</title>
</head>
<body>
  
<div class="top-bar">
  <div class="logo">
    <a href="index.php">You are not alone</a>
  </div>  
  <nav>
    <a href="#">
      <?php echo $user['first_name']; ?>
    </a>
    <a href="<?php echo $userLoggedIn; ?>">
      <i class="fas fa-home"></i>
    </a>
    <a href="#"><i class="far fa-envelope"></i></a>
    <a href="#"><i class="far fa-bell-o"></i></a>
    <a href="#"><i class="fas fa-users"></i></a>
    <a href="#"><i class="fas fa-cog"></i></a>
    <a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>
    
  </nav>
</div>

<div class="wrapper">