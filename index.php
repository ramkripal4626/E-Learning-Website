<?php
include 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Education Platform</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Hide the login popup initially */
    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 10px;
      width: 400px;
      z-index: 1000;
    }
    /* Close button for the popup */
    .close-popup {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }
    .login-toggle button {
      margin-right: 10px;
    }
    .login-toggle button.active {
      background-color: #007bff;
      color: #fff;
    }
    /* Basic styling for login form */
    .login-fields input {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="./image/LOGO_change.jpg" alt="Logo">
      <div class="logo"></div>
      <ul class="nav">
        <li><a href="indexmenu/about.php">About</a></li>
        <li><a href="#">Available Content</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#" id="login-btn">Login</a></li>
      </ul>
    </div>

    <div class="content">
      <div class="image">
        <img src="./image/e-learning.png" alt="Digital Education Platform">
      </div>
      <div class="text">
        <h1 class="title">Digital Education Platform</h1>
        <p class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p>
        <a href="#" class="button">Go Live</a>
      </div>
    </div>

    <footer>
      <div class="footer-content">
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
        <p>&copy; 2024 Vignan University. All rights reserved.</p>
        <div class="social-links">
          <a href="https://www.facebook.com/vignanuniversity" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com/Vignanuniv" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/vignanuniversity/" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/school/vignan-university/" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </footer>
  </div>

  <!-- The popup login form -->
  <div class="popup" id="login-popup">
    <span class="close-popup">&times;</span>
    <h2>Login</h2>
    <div class="login-toggle">
      <button type="button" class="student-login-btn active">Student</button>
      <button type="button" class="faculty-login-btn">Faculty</button>
    </div>
    <form id="login-form" method="post" action="./registration/login.php">
      <input type="hidden" id="login-type" name="login-type" value="student">
      <!-- Student and Faculty login form fields -->
      <div class="login-fields">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
      </div>
      <input type="submit" value="Login">
      <a href="./registration/registration.php" id="register-link" class="register-link">Don't have an account? Register here!</a>
    </form>
  </div>

  <script src="./js/login.js"></script>
  <script>
    // Open the login popup when clicking the login button
    document.getElementById('login-btn').addEventListener('click', function() {
      document.getElementById('login-popup').style.display = 'block';
    });

    // Close the login popup when clicking the close button
    document.querySelector('.close-popup').addEventListener('click', function() {
      document.getElementById('login-popup').style.display = 'none';
    });

    // Toggle between Student and Faculty login
    document.querySelector('.student-login-btn').addEventListener('click', function() {
      document.getElementById('login-type').value = 'student';
      this.classList.add('active');
      document.querySelector('.faculty-login-btn').classList.remove('active');
    });

    document.querySelector('.faculty-login-btn').addEventListener('click', function() {
      document.getElementById('login-type').value = 'faculty';
      this.classList.add('active');
      document.querySelector('.student-login-btn').classList.remove('active');
    });
  </script>
</body>
</html>
