<?php
session_start();
include '../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include './header.php'; ?>

    <!-- View Courses Section -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">View Courses</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Program</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // PHP code to retrieve and display courses from the database
                $sql = "SELECT DISTINCT 
                            c.course_name, 
                            s.subject_name 
                        FROM 
                            topics t 
                        INNER JOIN 
                            courses c ON t.program = c.course_id 
                        INNER JOIN 
                            subjects s ON t.subject = s.subject_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["course_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["subject_name"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center text-muted'>No courses found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <?php include './footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
