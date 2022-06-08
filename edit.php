<?php
require 'database.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM students WHERE id=:id';
$statement = $conn->prepare($sql);
$statement->execute([':id' => $id ]);
// devuelve un objeto anónimo con nombres de propiedades
$student = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['email']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = 'UPDATE students SET name=:name, email=:email WHERE id=:id';
  $statement = $conn->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':id' => $id])) {
    header("Location: /crud-php-mysql");
  }
}
?>


<div class="container">
<?php require 'partials/header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update student</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input value="<?= $student->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $student->email; ?>" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <button style="cursor: pointer;" type="submit" class="btn btn-info">Update student</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'partials/footer.php'; ?>
</div>

