<?php
// Include your database connection
include('../../connection.php');


// Initialize the $fields array
$fields = [];

// Example SQL query to fetch the required data
$sql = "SELECT subtopic_name, link1, rating1,description1, link2, rating2,description2, link3, rating3,description3 FROM topics";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch data and populate the $fields array
    while ($row = $result->fetch_assoc()) {
        $fields[] = [
            'subtopic_name' => $row['subtopic_name'],
            'link1' => $row['link1'],
            'rating1' => $row['rating1'],
            'description1' => $row['description1'],
            'link2' => $row['link2'],
            'rating2' => $row['rating2'],
            'description2' => $row['description2'],
            'link3' => $row['link3'],
            'rating3' => $row['rating3'],
            'description3' => $row['description3']
        ];
    }
} else {
    echo "No subtopics found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $field) {
        // Prepare the data for each subtopic
        $subtopic_name = $field['subtopic_name'];

        // Fetch existing data for this subtopic
        $existing_sql = "SELECT link1, rating1,description1, link2, rating2,description2, link3, rating3,description3 FROM topics WHERE subtopic_name = ?";
        $existing_stmt = $conn->prepare($existing_sql);
        $existing_stmt->bind_param('s', $subtopic_name);
        $existing_stmt->execute();
        $existing_result = $existing_stmt->get_result();
        $existing_data = $existing_result->fetch_assoc();

        // Use form data if provided, otherwise retain existing data
        $link1 = isset($_POST[$subtopic_name . '_link1']) && $_POST[$subtopic_name . '_link1'] !== '' ? $_POST[$subtopic_name . '_link1'] : $existing_data['link1'];
        $rating1 = isset($_POST[$subtopic_name . '_rating1']) && $_POST[$subtopic_name . '_rating1'] !== '' ? $_POST[$subtopic_name . '_rating1'] : $existing_data['rating1'];
        $description1 = isset($_POST[$subtopic_name . '_description1']) && $_POST[$subtopic_name . '_description1'] !== '' ? $_POST[$subtopic_name . '_description1'] : $existing_data['description1'];

        $link2 = isset($_POST[$subtopic_name . '_link2']) && $_POST[$subtopic_name . '_link2'] !== '' ? $_POST[$subtopic_name . '_link2'] : $existing_data['link2'];
        $rating2 = isset($_POST[$subtopic_name . '_rating2']) && $_POST[$subtopic_name . '_rating2'] !== '' ? $_POST[$subtopic_name . '_rating2'] : $existing_data['rating2'];
        $description2 = isset($_POST[$subtopic_name . '_description2']) && $_POST[$subtopic_name . '_description2'] !== '' ? $_POST[$subtopic_name . '_description2'] : $existing_data['description2'];

        $link3 = isset($_POST[$subtopic_name . '_link3']) && $_POST[$subtopic_name . '_link3'] !== '' ? $_POST[$subtopic_name . '_link3'] : $existing_data['link3'];
        $rating3 = isset($_POST[$subtopic_name . '_rating3']) && $_POST[$subtopic_name . '_rating3'] !== '' ? $_POST[$subtopic_name . '_rating3'] : $existing_data['rating3'];
        $description3 = isset($_POST[$subtopic_name . '_description3']) && $_POST[$subtopic_name . '_description3'] !== '' ? $_POST[$subtopic_name . '_description3'] : $existing_data['description3'];
        // Update the database for each link and rating
        $sql = "UPDATE topics SET 
        link1 = ?, rating1 = ?, description1 = ?, 
        link2 = ?, rating2 = ?, description2 = ?, 
        link3 = ?, rating3 = ?, description3 = ? 
    WHERE subtopic_name = ?";


        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }

        // Bind the parameters
        $stmt->bind_param('sissississ', $link1, $rating1, $description1, $link2, $rating2, $description2, $link3, $rating3, $description3, $subtopic_name);

        // Execute the query
        if (!$stmt->execute()) {
            echo "Error executing the query for subtopic $subtopic_name: " . $stmt->error;
        } else {
            echo "<script>alert('Update successful!')</script>";
            header("Location: ./facultyindex.php");
        }

        // Close the statement
        $stmt->close();
        $existing_stmt->close();
    }
}

// Close the database connection
$conn->close();
?>