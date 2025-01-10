<?php
include '../../connection.php';

if (isset($_POST['topic_name'])) {
    $topic_name = $_POST['topic_name'];
    $pre_topic_idx = $_POST['topic_index'];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT subtopic_name FROM topic WHERE topic_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $topic_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<ul class="list-group" style="padding-left: 0;">';
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $subtopic_name = $row['subtopic_name'];
            echo "<li class='list-group-item bg-light p-2 mb-2'>
                    <a href='#' onclick='fetchContent(\"$subtopic_name\")' class='text-primary'>
                    $pre_topic_idx.$i. <b>$subtopic_name</b></a>
                  </li>";
            $i++;
        }
        echo '</ul>';
    } else {
        echo '<p>No Subtopics Found</p>';
    }
}
?>
