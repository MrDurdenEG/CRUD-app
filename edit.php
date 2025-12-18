<?php
include 'auth.php';
include 'db.php';

$id = $_GET['id'];

if ($_SESSION['role'] != 'admin' && $_SESSION['id'] != $id) {
  echo "<script>alert('Access Denied: You can only edit your own profile.'); window.location='index.php';</script>";
  exit();
}

$result = mysqli_query($conn, "select * from users where id=$id");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];

  mysqli_query($conn, "update users set name='$name', email='$email', mobile='$mobile' where id=$id");
  header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <title>Edit User</title>
</head>

<body>
  <div class="container my-5">
    <h2>Update User</h2>

    <form method="post">
      <div class="form-group">
        <label for="nameInput">Name</label>
        <input type="text" class="form-control" id="nameInput" name="name" value="<?= $user['name'] ?>" required>
      </div>

      <div class="form-group">
        <label for="emailInput">Email address</label>
        <input type="email" class="form-control" id="emailInput" name="email" value="<?= $user['email'] ?>" required>
      </div>

      <div class="form-group">
        <label for="mobileInput">Mobile</label>
        <input type="tel" class="form-control" id="mobileInput" name="mobile" value="<?= $user['mobile'] ?>" required>
      </div>

      <button type="submit" name="save" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>

</html>