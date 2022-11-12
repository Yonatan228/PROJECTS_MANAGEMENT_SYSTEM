<?php
include 'functions.php';
if(isset($_POST['login'])){
  login();
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>
<body>
  <div class="login-box-container">
    <div class="login-box">
      <h2>Log in</h2>
      <br><br>
      <form method="post">
        <label for="email">Enter your Email address: </label><br><br>
        <input type="email" id="email" name="email" placeholder="email *" required>
        <br><br><br>
        <label for="email">Enter your password: </label><br><br>
        <input type="password" id="password" name="password" placeholder="password *" required>
        <br><br><br>
        <input type="submit" id="login" name="login" value="Log in">
      </form>
    </div>
  </div>
</body>
</html>