<?php
session_start();
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["topic"] != "new_topic") {
        $_SESSION["topic_name"] = $_GET["topic"];
    } else {
        $_SESSION["topic_name"] = $_GET["new_topic_name"];
    }
}
$program = $_SESSION['course'];
$branch = $_SESSION['branch'];
$semester = $_SESSION['semester'];
$subject = $_SESSION['subject'];

// Fetch existing topics from the database
$sql = "SELECT subject_name from subjects where subject_id='$subject'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$subject = $row['subject_name'];

// program name retrieval
$sql = "SELECT course_name from courses where course_id='$program'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$program = $row['course_name'];

// branch name retrieval
$sql = "SELECT branch_name from branches where branch_id='$branch'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$branch = $row['branch_name'];

// semester name retrieval
$sql = "SELECT semester_name from semesters where semester_id='$semester'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$semester = $row['semester_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Topic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/add_topic.css?v=<?php echo time(); ?>"> -->
    <style>
        /* Custom CSS for star rating */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            font-size: 24px;
            margin-right: 170px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            color: lightgray;
            padding: 0 2px;
        }

        .star-rating input[type="radio"]:checked ~ label {
            color: gold;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }

        .add-btn {
            display: inline-block;
            width: 30%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .add-btn:hover {
            background-color: #45a049;
        }

        
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Topic for <?php echo "$subject ($program - $semester)"; ?></h1>
        <form method="POST" action="save_topic.php">

            <div class="form-group">
                <label for="subtopic">Subtopic Name</label>
                <input type="text" name="subtopic" id="subtopic" class="form-control" required>
            </div>

            <hr class="my-4">

            <!-- Basic Level -->
            <div id="basic-links">
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="basic_title1">Basic Title 1</label>
                        <input type="text" name="basic_titles[]" id="basic_title1" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="col-md-6">
                        <label for="link1">Basic Link 1</label>
                        <input type="url" name="basic_links[]" id="link1" class="form-control">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>Basic Rating</label>
                        <div class="star-rating">
                            <input type="radio" name="basic_ratings[]" value="5" id="basic_rating1_5"><label for="basic_rating1_5">★</label>
                            <input type="radio" name="basic_ratings[]" value="4" id="basic_rating1_4"><label for="basic_rating1_4">★</label>
                            <input type="radio" name="basic_ratings[]" value="3" id="basic_rating1_3"><label for="basic_rating1_3">★</label>
                            <input type="radio" name="basic_ratings[]" value="2" id="basic_rating1_2"><label for="basic_rating1_2">★</label>
                            <input type="radio" name="basic_ratings[]" value="1" id="basic_rating1_1"><label for="basic_rating1_1">★</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="basic_description1">Basic Description 1</label>
                        <textarea name="basic_descriptions[]" id="basic_description1" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <button type="button" onclick="addMoreLinks('basic')" class="btn add-btn">Add More Basic Links</button>
            </div>

            <!-- Medium Level -->
            <hr class="my-4">
            <div id="medium-links">
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="medium_title1">Medium Title 1</label>
                        <input type="text" name="medium_titles[]" id="medium_title1" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="col-md-6">
                        <label for="link2">Medium Link 1</label>
                        <input type="url" name="medium_links[]" id="link2" class="form-control">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>Medium Rating</label>
                        <div class="star-rating">
                            <input type="radio" name="medium_ratings[]" value="5" id="medium_rating2_5"><label for="medium_rating2_5">★</label>
                            <input type="radio" name="medium_ratings[]" value="4" id="medium_rating2_4"><label for="medium_rating2_4">★</label>
                            <input type="radio" name="medium_ratings[]" value="3" id="medium_rating2_3"><label for="medium_rating2_3">★</label>
                            <input type="radio" name="medium_ratings[]" value="2" id="medium_rating2_2"><label for="medium_rating2_2">★</label>
                            <input type="radio" name="medium_ratings[]" value="1" id="medium_rating2_1"><label for="medium_rating2_1">★</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="medium_description1">Medium Description 1</label>
                        <textarea name="medium_descriptions[]" id="medium_description1" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <button type="button" onclick="addMoreLinks('medium')" class="btn add-btn">Add More Medium Links</button>
            </div>

            <!-- Advanced Level -->
            <hr class="my-4">
            <div id="advanced-links">
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="advanced_title1">Advanced Title 1</label>
                        <input type="text" name="advanced_titles[]" id="advanced_title1" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="col-md-6">
                        <label for="link3">Advanced Link 1</label>
                        <input type="url" name="advanced_links[]" id="link3" class="form-control">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label>Advanced Rating</label>
                        <div class="star-rating">
                            <input type="radio" name="advanced_ratings[]" value="5" id="advanced_rating3_5"><label for="advanced_rating3_5">★</label>
                            <input type="radio" name="advanced_ratings[]" value="4" id="advanced_rating3_4"><label for="advanced_rating3_4">★</label>
                            <input type="radio" name="advanced_ratings[]" value="3" id="advanced_rating3_3"><label for="advanced_rating3_3">★</label>
                            <input type="radio" name="advanced_ratings[]" value="2" id="advanced_rating3_2"><label for="advanced_rating3_2">★</label>
                            <input type="radio" name="advanced_ratings[]" value="1" id="advanced_rating3_1"><label for="advanced_rating3_1">★</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="advanced_description1">Advanced Description 1</label>
                        <textarea name="advanced_descriptions[]" id="advanced_description1" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <button type="button" onclick="addMoreLinks('advanced')" class="btn add-btn">Add More Advanced Links</button>
            </div>

            <input type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block mt-4" value="Save Topic">
        </form>
    </div>

    <script>
        let basicCount = 0;
        let mediumCount = 0;
        let advancedCount = 0;

        function addMoreLinks(level) {
    let container;
    let count;

    if (level === 'basic') {
        container = document.getElementById('basic-links');
        count = ++basicCount;
    } else if (level === 'medium') {
        container = document.getElementById('medium-links');
        count = ++mediumCount;
    } else if (level === 'advanced') {
        container = document.getElementById('advanced-links');
        count = ++advancedCount;
    }

    const uniqueId = `${level}_link${Date.now()}_${count}`;

    const linkHtml = `
        <div class="link-container" id="${uniqueId}">
            <hr>
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <label for="${uniqueId}_title">Title ${count}</label>
                    <input type="text" name="${level}_titles[]" id="${uniqueId}_title" class="form-control" placeholder="Enter title">
                </div>
                <div class="col-md-6">
                    <label for="${uniqueId}_link">Link ${count}</label>
                    <input type="url" name="${level}_links[]" id="${uniqueId}_link" class="form-control">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6">
                    <label>Rating</label>
                    <div class="star-rating">
                        <input type="radio" name="${level}_ratings[${count}]" value="5" id="${uniqueId}_rating_5">
                        <label for="${uniqueId}_rating_5">★</label>
                        <input type="radio" name="${level}_ratings[${count}]" value="4" id="${uniqueId}_rating_4">
                        <label for="${uniqueId}_rating_4">★</label>
                        <input type="radio" name="${level}_ratings[${count}]" value="3" id="${uniqueId}_rating_3">
                        <label for="${uniqueId}_rating_3">★</label>
                        <input type="radio" name="${level}_ratings[${count}]" value="2" id="${uniqueId}_rating_2">
                        <label for="${uniqueId}_rating_2">★</label>
                        <input type="radio" name="${level}_ratings[${count}]" value="1" id="${uniqueId}_rating_1">
                        <label for="${uniqueId}_rating_1">★</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="${uniqueId}_description">Description</label>
                    <textarea name="${level}_descriptions[]" id="${uniqueId}_description" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <button type="button" onclick="deleteField('${uniqueId}')" class="btn btn-danger btn-sm">Delete</button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', linkHtml);
}


        function deleteField(id) {
            const element = document.getElementById(id);
            element.remove();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
