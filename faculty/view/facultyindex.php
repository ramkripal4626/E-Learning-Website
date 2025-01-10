<?php
session_start();
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Web Page</title>
    <!-- Add Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include_once './header.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center">Faculty Web Page</h1>
        <div class="alert alert-info">
            <p>Welcome, <?php echo $_SESSION['username']; ?> Kumar</p>
            <p>Faculty Name: <?php echo $_SESSION['username']; ?></p>
            <p>Your have Logged In as: <?php echo $_SESSION['login_type']; ?></p>
        </div>

        <!-- Add Course Form -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Add New Course</h3>
            </div>
            <div class="card-body">
                <!-- Course Form -->
                <form>
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseName" placeholder="Enter course name">
                    </div>
                    <div class="mb-3">
                        <label for="courseCode" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="courseCode" placeholder="Enter course code">
                    </div>
                    <div class="mb-3">
                        <label for="courseDescription" class="form-label">Course Description</label>
                        <textarea class="form-control" id="courseDescription" rows="3" placeholder="Enter course description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once './footer.php'; ?>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
