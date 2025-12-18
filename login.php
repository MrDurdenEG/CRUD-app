<?php
session_start();
include 'db.php';
$error = "";

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $result = mysqli_query($conn, "select * from users where email='$email'");
  $user = mysqli_fetch_assoc($result);

  if ($user && password_verify($pass, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header("Location: index.php");
    exit();
  } else {
    $error = "Wrong email or password";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <title>Login</title>
</head>

<body>
  <div class="container my-5">

    <?php if ($error) { ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
      </div>
    <?php } ?>

    <form method="post">
      <div class="form-group">
        <label for="emailInput">Email</label>
        <input type="email" class="form-control" id="emailInput" name="email" aria-describedby="emailHelp"
          placeholder="Enter email" autocomplete="off" required>
      </div>

      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Login</button>
      <br><br>
      <a href="register.php">Don't have an account? Register here</a>
    </form>
  </div>
</body>

</html>