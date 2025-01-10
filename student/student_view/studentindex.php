<?php
session_start();
include '../../connection.php';

// Fetch any status messages
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once './header.php'; ?>

    <div class="container mt-5">
        <h1>Welcome to the Student Web Page</h1>
        <p>Hello, <?php echo $_SESSION['username']; ?> Kumar</p>
        <hr>
        <p>Faculty Name: <?php echo $_SESSION['username']; ?></p>
        <p>Your Login Type: <?php echo $_SESSION['login_type']; ?></p>

        <!-- Display status messages -->
        <?php if ($status): ?>
            <?php if ($status == 'success'): ?>
                <div class="alert alert-success">Rating submitted successfully!</div>
            <?php elseif ($status == 'error'): ?>
                <div class="alert alert-danger">An error occurred while submitting your rating. Please try again.</div>
            <?php elseif ($status == 'invalid_rating'): ?>
                <div class="alert alert-warning">Please provide a valid rating between 1 and 5 stars.</div>
            <?php elseif ($status == 'missing_data'): ?>
                <div class="alert alert-danger">Required data is missing. Please try again.</div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Add Course Form -->
        <h3>Rate a Video</h3>
        <form action="rate_video.php" method="POST">
            <div class="mb-3">
                <label for="video_id" class="form-label">Video ID</label>
                <input type="number" class="form-control" id="video_id" name="video_id" required>
            </div>
            <div class="mb-3">
                <label for="subtopic_id" class="form-label">Subtopic ID</label>
                <input type="number" class="form-control" id="subtopic_id" name="subtopic_id" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </form>
    </div>

    <?php include_once('./footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
