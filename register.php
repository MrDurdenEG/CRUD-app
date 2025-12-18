<?php
include 'db.php';

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];

  $sql = "insert into users (name, email, mobile, password, role) values ('$name', '$email', '$mobile', '$password', '$role')";
  mysqli_query($conn, $sql);
  header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <title>Register</title>
</head>

<body>
  <div class="container my-5">
    <form method="post">
      <div class="form-group">
        <label for="nameInput">Name</label>
        <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter Name" autocomplete="off"
          required>
      </div>

      <div class="form-group">
        <label for="emailInput">Email</label>
        <input type="email" class="form-control" id="emailInput" name="email" aria-describedby="emailHelp"
          placeholder="Enter email" autocomplete="off" required>
      </div>

      <div class="form-group">
        <label for="mobileInput">Mobile</label>
        <input type="tel" class="form-control" id="mobileInput" name="mobile" placeholder="Enter Mobile Number"
          autocomplete="off" required>
      </div>

      <div class="form-group">
        <label for="roleInput">Role</label>
        <select class="form-control" id="roleInput" name="role" required>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      <br><br>
      <a href="login.php">Already have an account? Login here</a>
    </form>
  </div>
</body>

</html>