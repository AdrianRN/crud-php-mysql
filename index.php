<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

  // CRUD
  $sql = 'SELECT * FROM students';
  $statement = $conn->prepare($sql);
  $statement->execute();
  $students = $statement->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container">
    <?php require 'partials/header.php' ?>
<br>
    <?php if(!empty($user)): ?>
      <br>
      <p style="display: inline; color: #fff;">Welcome. <?= $user['email']; ?></p>
      <br>
      <p style="display: inline; color: #fff;">You are Successfully Logged In</p>
      <br><br>
      <a class="text-warning font-weight-bold" href="logout.php">
        Logout
      </a>

      <!-- Here goes table -->

      <div class="container">
        <div class="card mt-5">
          <div class="card-header">
            <h2>All students</h2>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
              <?php foreach($students as $student): ?>
                <tr>
                  <td><?= $student->id; ?></td>
                  <td><?= $student->name; ?></td>
                  <td><?= $student->email; ?></td>
                  <td>
                    <a href="edit.php?id=<?= $student->id ?>" class="btn btn-info">Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $student->id ?>" class='btn btn-danger'>Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>


    <?php else: ?>
      <h1 class="text-light">Please Login or SignUp</h1>

      <a class="text-warning" href="login.php">Login</a> <p style="display: inline; color: #fff;">or</p>
      <a class="text-warning" href="signup.php">SignUp</a>
    <?php endif; ?>
    <?php require 'partials/footer.php' ?>
    </div>
  
