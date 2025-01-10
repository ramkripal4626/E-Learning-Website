<?php
session_start();
include '../../connection.php';
include './header.php';

$subject = $_POST['subject'];

$sql = "SELECT subject_name FROM subjects WHERE subject_id=$subject";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$subject_name = $row['subject_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Subject: <?php echo htmlspecialchars($subject_name); ?></h1>
    <div class="list-group">
        <?php
        if (isset($subject)) {
            $sql = "SELECT DISTINCT topic_name FROM topics WHERE subject = '$subject'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $topic_name = $row['topic_name'];
                    echo "<a href='#' class='list-group-item list-group-item-action' data-topic-name='$topic_name'>$topic_name</a>";
                }
            } else {
                echo '<p class="text-muted">No Topics Found</p>';
            }
        }
        ?>
    </div>
    <div id="subtopics-container" class="mt-4"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var subtopicLinks = document.querySelectorAll('.list-group-item');
        subtopicLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior
                var topicName = link.getAttribute('data-topic-name');
                fetchSubtopics(topicName);
            });
        });
    });

    function fetchSubtopics(topicName) {
        // Make an AJAX request to fetch subtopics
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_course.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('subtopics-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send('topic_name=' + encodeURIComponent(topicName));
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
<?php include './footer.php'; ?>
</html>
