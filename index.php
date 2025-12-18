<?php
include 'auth.php';
include 'db.php';

if (isset($_GET['delete_id'])) {
  if ($_SESSION['role'] == 'admin') {
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: index.php");
  }
}

$result = mysqli_query($conn, "select * from users");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <title>Users</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">User Management</a>
      <div class="d-flex align-items-center">
        <span class="text-white mr-3">Hello, <?= $_SESSION['role'] ?></span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>All Users</h3>
      <a href="register.php" class="btn btn-primary">Add New User</a>
    </div>

    <table class="table table-bordered table-striped text-center">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td>
              <?php if ($row['role'] == 'admin') { ?>
                <span class="badge badge-danger">admin</span>
              <?php } else { ?>
                <span class="badge badge-secondary">user</span>
              <?php } ?>
            </td>
            <td>
              <?php if ($_SESSION['role'] == 'admin' || $_SESSION['id'] == $row['id']) { ?>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <?php } ?>

              <?php if ($_SESSION['role'] == 'admin') { ?>
                <a href="index.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                  onclick="return confirm('Are you sure?')">Delete</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>