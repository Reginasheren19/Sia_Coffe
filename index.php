<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['role'] == 'YES'){
  if ($_SESSION['role'] == 'admin') {
        header("location:admin/dashboard_admin.php");
    } elseif ($_SESSION['role'] == 'user') {
        header("location:dashboard_user.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="login.php" method="POST">
        <input type="username" name="username" placeholder="Enter your username">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" class="button" value="Login">
      
    </div>
  </div>
</body>
</html>
