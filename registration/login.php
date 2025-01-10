<?php
include '../connection.php';
$loginType = $_POST['login-type'];
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && isset($password)) {
    if ($loginType === 'student') {
        $sql = "SELECT * FROM student WHERE username='$username' AND pass='$password'";
    } else if ($loginType === 'faculty') {
        $sql = "SELECT * FROM faculty WHERE username='$username' AND pass='$password'";
    }
    
    $result = mysqli_query($conn, $sql);

    //start the session when the user is logged in.
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['login_type'] = $loginType;
    
    if (mysqli_num_rows($result) > 0) {
        if ($loginType === 'student') {
            header('Location: ../student/student_view/studentindex.php');
        } else if ($loginType === 'faculty') {
            header('Location: ../faculty/view/facultyindex.php');
        }
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        echo "<script>window.location.href='../index.php';</script>";
    }
} else {
    echo "<script>alert('Please enter your credentials');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}
?>
