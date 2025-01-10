<?php
include '../../connection.php';

$video_id = $_POST['video_id'];
$subtopic_id = $_POST['subtopic_id'];
$rating = $_POST['rating'];

// Insert a new rating into the database
$stmt = $conn->prepare("INSERT INTO ratings (video_id, subtopic_id, rating) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $video_id, $subtopic_id, $rating);
$stmt->execute();

// Redirect back to the original page
header('Location:./studentindex.php ');
exit;
?>