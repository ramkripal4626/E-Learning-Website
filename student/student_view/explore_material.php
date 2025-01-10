<?php
session_start();
include '../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Course</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="form-container p-4 shadow-sm bg-white rounded">
            <h1 class="text-center mb-4">Course Details</h1>
            <form method="POST" action="fetch_courses.php">
                <div class="form-group">
                    <label for="course-dropdown">Select Course</label>
                    <select id="course-dropdown" name="course" class="form-control">
                        <option value="">Select Course</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="branch-dropdown">Select Branch</label>
                    <select id="branch-dropdown" name="branch" class="form-control">
                        <option value="">Select Branch</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="semester-dropdown">Select Semester</label>
                    <select id="semester-dropdown" name="semester" class="form-control">
                        <option value="">Select Semester</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject-dropdown">Select Subject</label>
                    <select id="subject-dropdown" name="subject" class="form-control">
                        <option value="">Select Subject</option>
                    </select>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-success btn-block">Fetch Topic</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script src="../../ajax/script.js"></script>
</body>

</html>
