<?php
include '../../connection.php';

// Get input from user
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $course = $_POST['course'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];

    // SQL query to fetch data from database
    $sql = "SELECT * FROM topics WHERE program = '$course' AND semester = '$branch' and semester='$semester' GROUP BY subject";    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        $courses_found = true;
    } else {
        $courses_found = false;
    }
    $sql="SELECT course_name FROM courses where course_id='$course'";
    $course_result=mysqli_query($conn,$sql);
    $course_name=mysqli_fetch_assoc($course_result);

    $branch="SELECT branch_name FROM branches where branch_id='$branch'";
    $branch_result=mysqli_query($conn,$branch);
    $branch_name=mysqli_fetch_assoc($branch_result);

    $semester="SELECT semester_name FROM semesters where semester_id='$semester'";
    $semester_result=mysqli_query($conn,$semester);
    $semester_name=mysqli_fetch_assoc($semester_result);
    
}
include './header.php'; 
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../ajax/script.js"></script>

<div class="container mt-5">
    <h2>View Courses</h2>
    <form action="view_courses.php" method="post" class="mb-4">
        <div class="form-group">
            <label for="course-dropdown">Course</label>
            <select id="course-dropdown" name="course" class="form-control">
                <option value="">Select Course</option>
            </select>
        </div>
        <div class="form-group">
            <label for="branch-dropdown">Branch</label>
            <select id="branch-dropdown" name="branch" class="form-control">
                <option value="">Select Branch</option>
            </select>
        </div>
        <div class="form-group">
            <label for="semester-dropdown">Semester</label>
            <select id="semester-dropdown" name="semester" class="form-control">
                <option value="">Select Semester</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">View Courses</button>
    </form>
    
    <a href="javascript:history.go(-1)" class="btn btn-secondary">Back to Previous Page</a>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <?php if ($courses_found) { ?>
            <h3>Subjects under <?php echo $course_name['course_name']; ?>, Branch: <?php echo $branch_name['branch_name']; ?>, <?php echo $semester_name['semester_name']; ?>:</h3>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Subject Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <?php 
                            $subject = $row['subject'];
                            $subject_name_sql = "SELECT subject_name from subjects where subject_id='$subject'";
                            $subject_name_result = mysqli_query($conn, $subject_name_sql);
                            $subject_name = mysqli_fetch_assoc($subject_name_result);
                            ?>
                            <td><?php echo $subject_name['subject_name'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No courses found.</p>
        <?php } ?>
    <?php } ?>
</div>

<?php include './footer.php'; ?>
