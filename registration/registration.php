<?php
include '../connection.php';

if (isset($_POST['submit'])) {
  $usertype = $_POST['user-type'];
  $name1 = $_POST['name'];
  $email1 = $_POST['email'];
  $usernames = $_POST['username'];
  $pass = $_POST['password'];
  $conformpass = $_POST['confirm-password'];

  if ($pass === $conformpass) {
    if (isset($name1) or isset($email1) or isset($usernames) or isset($pass) or isset($conformpass)) {

      if ($usertype === "student") {
        $sql = "INSERT INTO student (name1, email1, username, pass) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name1, $email1, $usernames, $pass);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php');
        exit();
      } else {
        $sql = "INSERT INTO faculty (name1, email1, username, pass) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name1, $email1, $usernames, $pass);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php');
        exit();
      }
    } else {
      echo "<script>alert('Please fill all the fields');</script>";
    }
  } else {
    echo "<script>alert('Passwords do not match');</script>";
  }

  mysqli_close($conn);
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f9f4;
    }

    .container {
      width: 50%;
      margin: 40px auto;
      padding: 30px;
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="text-center">Register</h2>
    <form id="register-form" method="post" action="">
      <div class="form-group">
        <label for="user-type">User Type:</label>
        <select id="user-type" name="user-type" class="form-control" required>
          <option value="student">Student</option>
          <option value="faculty">Faculty</option>
        </select>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
    </form>
  </div>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  

</body>
</html>
