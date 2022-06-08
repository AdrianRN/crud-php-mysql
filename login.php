<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /crud-php-mysql');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (is_countable($results) && count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /crud-php-mysql");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

    <div class="container text-center">
      <?php require 'partials/header.php' ?>

      <?php if(!empty($message)): ?>
        <p class="text-light"><u><?= $message ?></u></p>
      <?php endif; ?>
  
      <h1 class="text-light">Login</h1>
      <span class="text-light">or <a class="text-warning font-weight-bold" href="signup.php">SignUp</a></span>
  
      <form action="login.php" method="POST">
        <input class="input-style" name="email" type="text" placeholder="Enter your email">
        <input class="input-style" name="password" type="password" placeholder="Enter your Password">
        <input class="submit-style" type="submit" value="Submit">
      </form>
      <?php require 'partials/footer.php' ?>
    </div>
