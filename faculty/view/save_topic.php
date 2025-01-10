<?php
session_start();
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = $_SESSION['topic_name'];
    $subtopic = $_POST['subtopic'];

    // Prepare data for JSON encoding for Basic, Medium, and Advanced levels
    $basic_links = isset($_POST['basic_links']) ? json_encode($_POST['basic_links']) : null;
    $basic_titles = isset($_POST['basic_titles']) ? json_encode($_POST['basic_titles']) : null;
    $basic_descriptions = isset($_POST['basic_descriptions']) ? json_encode($_POST['basic_descriptions']) : null;
    $basic_ratings = isset($_POST['basic_ratings']) ? json_encode($_POST['basic_ratings']) : null;

    $medium_links = isset($_POST['medium_links']) ? json_encode($_POST['medium_links']) : null;
    $medium_titles = isset($_POST['medium_titles']) ? json_encode($_POST['medium_titles']) : null;
    $medium_descriptions = isset($_POST['medium_descriptions']) ? json_encode($_POST['medium_descriptions']) : null;
    $medium_ratings = isset($_POST['medium_ratings']) ? json_encode($_POST['medium_ratings']) : null;

    $advanced_links = isset($_POST['advanced_links']) ? json_encode($_POST['advanced_links']) : null;
    $advanced_titles = isset($_POST['advanced_titles']) ? json_encode($_POST['advanced_titles']) : null;
    $advanced_descriptions = isset($_POST['advanced_descriptions']) ? json_encode($_POST['advanced_descriptions']) : null;
    $advanced_ratings = isset($_POST['advanced_ratings']) ? json_encode($_POST['advanced_ratings']) : null;


    $program = $_SESSION['course'];
    $semester = $_SESSION['semester'];
    $subject = $_SESSION['subject'];

    $stmt = $conn->prepare("INSERT INTO topic (program, semester, subject, topic_name, subtopic_name, basic_links, basic_titles, basic_descriptions, medium_links, medium_titles, medium_descriptions, advanced_links, advanced_titles, advanced_descriptions, rating1, rating2, rating3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssss", $program, $semester, $subject, $topic, $subtopic, $basic_links, $basic_titles, $basic_descriptions, $medium_links, $medium_titles, $medium_descriptions, $advanced_links, $advanced_titles, $advanced_descriptions, $basic_ratings, $medium_ratings, $advanced_ratings);
    if ($stmt->execute()) {
        $success = true;
    } else {
        $error = $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Added</title>
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-top: 0;
        }

        .success-message {
            color: #4CAF50;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .error-message {
            color: #E74C3C;
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="form-container">
        <?php if (isset($success) && $success): ?>
            <h1 class="success-message">Topic added successfully!</h1>
        <?php elseif (isset($error)): ?>
            <h1 class="error-message">Error: <?php echo htmlspecialchars($error); ?></h1>
        <?php endif; ?>
        <a href="addcourse.php">Add Another Topic</a>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>