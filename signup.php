<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>

<div class="container text-center">

  <?php require 'partials/header.php' ?>

  <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <h1 class="text-light">SignUp</h1>
  <span class="text-light">or <a class="text-warning font-weight-bold" href="login.php">Login</a></span>

  <form action="signup.php" method="POST">
    <input class="input-style" name="email" type="email" placeholder="Enter your email">
    <input class="input-style" name="password" type="password" placeholder="Enter your Password">
    <input class="input-style" name="confirm_password" type="password" placeholder="Confirm Password">
    <input class="submit-style" type="submit" value="Submit">
  </form>
  <?php require 'partials/footer.php' ?>
</div>

