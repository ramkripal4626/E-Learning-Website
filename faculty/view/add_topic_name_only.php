<?php
session_start();
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $program = $_GET['course'];
    $branch = $_GET['branch'];
    $semester = $_GET['semester'];
    $subject = $_GET['subject'];

    // Fetch existing topics from the database
    $query = "SELECT DISTINCT topic_name FROM topic WHERE program='$program' AND semester='$semester' AND subject='$subject'";
    $result = $conn->query($query);

    $topics = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $topics[] = $row;
        }
    }

    $_SESSION['course'] = $program;
    $_SESSION['branch'] = $branch;
    $_SESSION['semester'] = $semester;
    $_SESSION['subject'] = $subject;

    // Subject name retrieval
    $sql = "SELECT subject_name FROM subjects WHERE subject_id='$subject'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $subject = $row['subject_name'];

    // Program name retrieval
    $sql = "SELECT course_name FROM courses WHERE course_id='$program'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $program = $row['course_name'];

    // Branch name retrieval
    $sql = "SELECT branch_name FROM branches WHERE branch_id='$branch'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $branch = $row['branch_name'];

    // Semester name retrieval
    $sql = "SELECT semester_name FROM semesters WHERE semester_id='$semester'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $semester = $row['semester_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Topic</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Add Topic for <?php echo "$subject ($program - $semester)"; ?></h1>

                <form method="GET" action="add_topic_page.php">
                    <!-- Topic selection dropdown -->
                    <div class="mb-3">
                        <label for="topic" class="form-label"><strong>Select Chapter:</strong></label>
                        <select name="topic" id="topic" class="form-select">
                            <option value="">Select Chapter</option>
                            <?php foreach ($topics as $topic) { ?>
                                <option value="<?= $topic['topic_name']; ?>"><?= $topic['topic_name']; ?></option>
                            <?php } ?>
                            <option value="new_topic">Add New Chapter</option>
                        </select>
                    </div>

                    <!-- New topic input field (hidden by default) -->
                    <div id="new_topic_field" class="mb-3" style="display: none;">
                        <label for="new_topic_name" class="form-label"><strong>Enter New Topic Name:</strong></label>
                        <input type="text" name="new_topic_name" id="new_topic_name" class="form-control" placeholder="Enter new topic name">
                    </div>

                    <input type="submit" name="submit" id="submit" class="btn btn-success w-100" value="Next">
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to toggle new topic input field -->
    <script>
        document.getElementById('topic').addEventListener('change', function () {
            if (this.value === 'new_topic') {
                document.getElementById('new_topic_field').style.display = 'block';
            } else {
                document.getElementById('new_topic_field').style.display = 'none';
            }
        });
    </script>
</body>

</html>
