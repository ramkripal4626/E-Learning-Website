<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom styles for the sticky footer */
        html,
        body {
            height: 100%;
        }

        .content {
            min-height: calc(100vh - 100px); /* Adjust height to leave space for footer */
        }

        footer {
            background-color: #343a40;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body class="d-flex flex-column">

    <!-- Header Section -->
    <header class="d-flex justify-content-between align-items-center py-3 bg-light">
        <div class="logo">
            <img src="../image/LOGO_change.jpg" alt="Logo" class="img-fluid" style="max-height: 60px;">
        </div>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Available Content</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#" id="login-btn">Login</a></li>
        </ul>
    </header>

    <!-- About Us Section -->
    <div class="container mt-5 content">
        <div class="card shadow-sm p-4">
            <h1 class="text-center mb-4">About Us</h1>
            <p>Welcome to our e-content learning platform! We provide a vast repository of educational resources, including videos, PPTs, and study materials, accessible to everyone. Our mission is to make learning easy, engaging, and accessible to all.</p>
            <p>Our platform offers a wide range of courses and subjects, covering various disciplines and interests. Whether you're a student, teacher, or lifelong learner, we have something for everyone. Our resources are carefully curated to ensure they are accurate, relevant, and up-to-date.</p>
            <p>Our goal is to bridge the gap between education and accessibility, making it possible for anyone to acquire knowledge and skills from anywhere, at any time. We believe that education is the key to unlocking individual potential, and we're committed to providing the best possible learning experience for our users.</p>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="py-3 mt-auto">
        <div class="container text-center">
            <ul class="list-inline mb-3">
                <li class="list-inline-item"><a href="#" class="text-white">About Us</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Contact Us</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Terms of Service</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Privacy Policy</a></li>
            </ul>
            <p>&copy; 2024 Vignan University. All rights reserved.</p>
            <div>
                <a href="https://www.facebook.com/vignanuniversity" target="_blank" class="text-white mx-2"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/Vignanuniv" target="_blank" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/vignanuniversity/" target="_blank" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/school/vignan-university/" target="_blank" class="text-white mx-2"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
