<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch-Courses</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php
    session_start();
    include '../../connection.php';
    include './header.php';

    if (isset($_POST['subject']) && !empty($_POST['subject'])) {
        $subject = $_POST['subject'];

        // Prepared statements for better security and performance
        $sql = "SELECT DISTINCT topic_name FROM topic WHERE subject = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $subject);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $subject_name_sql = "SELECT subject_name FROM subjects WHERE subject_id = ?";
        $subject_name_stmt = mysqli_prepare($conn, $subject_name_sql);
        mysqli_stmt_bind_param($subject_name_stmt, "s", $subject);
        mysqli_stmt_execute($subject_name_stmt);
        $subject_name_result = mysqli_stmt_get_result($subject_name_stmt);
        $subject_name = mysqli_fetch_assoc($subject_name_result);

        if ($subject_name) {
            echo "<h3 class='text-center mb-3'>Subject: {$subject_name['subject_name']}</h3>";
            echo "<h4 class='ml-3'>Chapter</h4>";

            if (mysqli_num_rows($result) > 0) {
                echo '<ul class="list-group">';
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $topic_name = $row['topic_name'];
                    echo "<li class='list-group-item'>
                            <a href='#' onclick='fetchSubtopics(\"$i.$topic_name\")' class='font-weight-bold text-success'>$i. $topic_name</a>
                          </li>";
                    $i++;
                }
                echo '</ul>';
            } else {
                echo '<p>No Courses Found</p>';
            }
        } else {
            echo '<p>Subject not found</p>';
        }
    } else {
        echo '<p>Invalid or missing subject</p>';
    }
    ?>

    <script>
        function fetchSubtopics(topicIdentifier) {
            const parts = topicIdentifier.split('.');
            const index = parts[0].trim();
            const topicName = parts.slice(1).join('.').trim();

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_subtopics.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    var topicElement = document.querySelector(`a[onclick='fetchSubtopics("${topicIdentifier}")']`);

                    var openSubtopics = document.querySelector('.subtopics-container');
                    if (openSubtopics) {
                        openSubtopics.remove();
                    } else {
                        var subtopicsContainer = document.createElement('div');
                        subtopicsContainer.innerHTML = response;
                        subtopicsContainer.className = 'subtopics-container p-3 bg-light border rounded mt-3';
                        subtopicsContainer.setAttribute('data-index', index);
                        topicElement.parentElement.appendChild(subtopicsContainer);
                    }
                }
            };
            xhr.send('topic_name=' + encodeURIComponent(topicName) + '&topic_index=' + encodeURIComponent(index));
        }

        function fetchContent(subtopic_name) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_content.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    var subtopicElement = document.querySelector(`a[onclick='fetchContent("${subtopic_name}")']`);

                    // Close any existing content container
                    var existingContent = document.querySelector('.content-container');
                    if (existingContent) {
                        existingContent.remove();
                    }

                    // Create a new content container
                    var contentContainer = document.createElement('div');
                    contentContainer.innerHTML = response;
                    contentContainer.className = 'content-container p-3 bg-white border rounded mt-3';
                    contentContainer.setAttribute('data-subtopic', subtopic_name);

                    // Insert the new content container after the subtopic
                    subtopicElement.parentElement.appendChild(contentContainer);
                }
            };
            xhr.send('subtopic_name=' + subtopic_name);
        }
    </script>

   <!-- Modal window using Bootstrap modal -->
<div id="video-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="video-iframe" src="" frameborder="0" allowfullscreen style="width: 100%; height: 400px;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open the video modal
    function openVideoModal(videoId) {
        var iframe = document.getElementById('video-iframe');
        iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1'; // Autoplay the video
        $('#video-modal').modal('show');
    }

    function closeModal() {
        var iframe = document.getElementById('video-iframe');
        iframe.src = '';  // Stop the video
        $('#video-modal').modal('hide');
    }

    // Optional: Stop the video when closing the modal using Bootstrap's 'hidden.bs.modal' event
    $('#video-modal').off('hidden.bs.modal').on('hidden.bs.modal', function () {
        var iframe = document.getElementById('video-iframe');
        iframe.src = '';  // Clear the video source to stop playback
    });
</script>


    <?php include './footer.php'; ?>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
