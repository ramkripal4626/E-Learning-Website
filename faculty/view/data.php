<?php
include '../../connection.php';

$type = $_GET['type'];

if ($type == 'courses') {
    $query = "SELECT course_id, course_name FROM courses";
    $result = mysqli_query($conn, $query);
    $courses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
    echo json_encode($courses);
}

if ($type == 'branches') {
    $course_id = $_GET['course_id'];
    $query = "SELECT branch_id, branch_name FROM branches WHERE course_id = $course_id";
    $result = mysqli_query($conn, $query);
    $branches = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $branches[] = $row;
    }
    echo json_encode($branches);
}

if ($type == 'semesters') {
    $branch_id = $_GET['branch_id'];
    $query = "SELECT semester_id, semester_name FROM semesters WHERE branch_id = $branch_id";
    $result = mysqli_query($conn, $query);
    $semesters = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $semesters[] = $row;
    }
    echo json_encode($semesters);
}

// Fetch subjects based on branch_id and semester_id
if ($type === 'subjects' && isset($_GET['branch_id'], $_GET['semester_id'])) {
    $branch_id = (int)$_GET['branch_id'];
    $semester_id = (int)$_GET['semester_id'];

    if ($branch_id > 0 && $semester_id > 0) {
        $sql = "SELECT subject_id, subject_name FROM subjects WHERE branch_id = ? AND semester_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $branch_id, $semester_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $subjects = array();
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        echo json_encode($subjects);
        $stmt->close();
    } else {
        echo json_encode(array());
    }
}

?>
