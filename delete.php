<?php
require 'database.php';
$id = $_GET['id'];
$sql = 'DELETE FROM students WHERE id=:id';
$statement = $conn->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: /crud-php-mysql");
}