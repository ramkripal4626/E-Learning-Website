<?php
session_start();
include '../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Topic</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="text-center mb-4">Edit Topic</h1>
                <form method="POST" action="fetch_course.php">
                    <!-- Course Dropdown -->
                    <div class="mb-3">
                        <label for="course-dropdown" class="form-label">Select Course</label>
                        <select id="course-dropdown" name="program" class="form-select" aria-label="Select Course">
                            <option value="">Select Course</option>
                        </select>
                    </div>

                    <!-- Branch Dropdown -->
                    <div class="mb-3">
                        <label for="branch-dropdown" class="form-label">Select Branch</label>
                        <select id="branch-dropdown" name="branch" class="form-select" aria-label="Select Branch">
                            <option value="">Select Branch</option>
                        </select>
                    </div>

                    <!-- Semester Dropdown -->
                    <div class="mb-3">
                        <label for="semester-dropdown" class="form-label">Select Semester</label>
                        <select id="semester-dropdown" name="semester" class="form-select" aria-label="Select Semester">
                            <option value="">Select Semester</option>
                        </select>
                    </div>

                    <!-- Subject Dropdown -->
                    <div class="mb-3">
                        <label for="subject-dropdown" class="form-label">Select Subject</label>
                        <select id="subject-dropdown" name="subject" class="form-select" aria-label="Select Subject">
                            <option value="">Select Subject</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit" id="submit" class="btn btn-success w-100">Fetch Subject</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Custom Script (for AJAX) -->
    <script src="../../ajax/script.js"></script>
</body>

</html>
