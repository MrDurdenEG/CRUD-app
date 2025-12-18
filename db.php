<?php
$conn = new mysqli("localhost", "root", "", "user_app");
if (!$conn) {
  die(mysqli_error($conn));
}