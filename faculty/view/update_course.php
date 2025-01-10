<?php
session_start();
include '../../connection.php';

$update_subject = $_POST['topic_name'];
echo $update_subject;
// Query to fetch the content from the database
$query = "SELECT * FROM topic WHERE topic_name='$update_subject'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $fields = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $fields[] = $row;
    }
} else {
    echo "No data found";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Content</title>
    <link rel="stylesheet" href="../css/update_course.css?v=<?php echo time(); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: none;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        td:nth-child(1) {
            width: 20%;
            font-weight: bold;
        }

        td:nth-child(2) {
            width: 80%;
        }

        input[type="text"],
        input[type="url"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            resize: vertical;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .star-rating {
            display: flex;
            justify-content: flex-start;
            direction: rtl;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            color: lightgray;
            padding: 0 5px;
        }

        .star-rating input[type="radio"]:checked~label {
            color: gold;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
        }

        .link-section {
            margin-bottom: 30px;
        }

        .add-more {
            font-size: 14px;
            padding: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php echo "<h1>$update_subject</h1>"; ?>
    <form action="update_save_courses.php" method="POST" onsubmit="mergeLinks()">
        <table>
            <?php foreach ($fields as $field) { 
                // Split links by comma
                $links1 = explode(',', $field['link1']);
                $links2 = explode(',', $field['link2']);
                $links3 = explode(',', $field['link3']);
                ?>
                <tr>
                    <td><?php echo ucfirst(str_replace('_', ' ', $field['subtopic_name'])); ?>:</td>
                    <td>

                        <!-- Link 1 Section -->
                        <div class="link-section">
                            <label for="<?php echo $field['subtopic_name']; ?>_link1">Reference Link 1:</label>
                            <div id="<?php echo $field['subtopic_name']; ?>_link1_container">
                                <?php foreach ($links1 as $link) { ?>
                                    <textarea name="<?php echo $field['subtopic_name']; ?>_links1[]"><?php echo trim($link); ?></textarea><br>
                                <?php } ?>
                            </div>

                            <!-- Rating 1 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_rating1">Rating 1:</label>
                            <div class="star-rating">
                                <?php for ($i = 5; $i >= 1; $i--) : ?>
                                    <input type="radio" id="<?php echo $field['subtopic_name']; ?>rating1<?php echo $i; ?>" name="<?php echo $field['subtopic_name']; ?>_rating1" value="<?php echo $i; ?>" <?php if ($field['rating1'] == $i) echo 'checked'; ?>>
                                    <label for="<?php echo $field['subtopic_name']; ?>rating1<?php echo $i; ?>">&#9733;</label>
                                <?php endfor; ?>
                            </div>

                            <!-- Description 1 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_description1">Description 1:</label>
                            <textarea name="<?php echo $field['subtopic_name']; ?>_description1"><?php echo $field['description1']; ?></textarea><br>
                        </div>

                        <!-- Link 2 Section -->
                        <div class="link-section">
                            <label for="<?php echo $field['subtopic_name']; ?>_link2">Reference Link 2:</label>
                            <div id="<?php echo $field['subtopic_name']; ?>_link2_container">
                                <?php foreach ($links2 as $link) { ?>
                                    <textarea name="<?php echo $field['subtopic_name']; ?>_links2[]"><?php echo trim($link); ?></textarea><br>
                                <?php } ?>
                            </div>

                            <!-- Rating 2 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_rating2">Rating 2:</label>
                            <div class="star-rating">
                                <?php for ($i = 5; $i >= 1; $i--) : ?>
                                    <input type="radio" id="<?php echo $field['subtopic_name']; ?>rating2<?php echo $i; ?>" name="<?php echo $field['subtopic_name']; ?>_rating2" value="<?php echo $i; ?>" <?php if ($field['rating2'] == $i) echo 'checked'; ?>>
                                    <label for="<?php echo $field['subtopic_name']; ?>rating2<?php echo $i; ?>">&#9733;</label>
                                <?php endfor; ?>
                            </div>

                            <!-- Description 2 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_description2">Description 2:</label>
                            <textarea name="<?php echo $field['subtopic_name']; ?>_description2"><?php echo $field['description2']; ?></textarea><br>
                        </div>

                        <!-- Link 3 Section -->
                        <div class="link-section">
                            <label for="<?php echo $field['subtopic_name']; ?>_link3">Reference Link 3:</label>
                            <div id="<?php echo $field['subtopic_name']; ?>_link3_container">
                                <?php foreach ($links3 as $link) { ?>
                                    <textarea name="<?php echo $field['subtopic_name']; ?>_links3[]"><?php echo trim($link); ?></textarea><br>
                                <?php } ?>
                            </div>

                            <!-- Rating 3 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_rating3">Rating 3:</label>
                            <div class="star-rating">
                                <?php for ($i = 5; $i >= 1; $i--) : ?>
                                    <input type="radio" id="<?php echo $field['subtopic_name']; ?>rating3<?php echo $i; ?>" name="<?php echo $field['subtopic_name']; ?>_rating3" value="<?php echo $i; ?>" <?php if ($field['rating3'] == $i) echo 'checked'; ?>>
                                    <label for="<?php echo $field['subtopic_name']; ?>rating3<?php echo $i; ?>">&#9733;</label>
                                <?php endfor; ?>
                            </div>

                            <!-- Description 3 -->
                            <label for="<?php echo $field['subtopic_name']; ?>_description3">Description 3:</label>
                            <textarea name="<?php echo $field['subtopic_name']; ?>_description3"><?php echo $field['description3']; ?></textarea><br>
                        </div>

                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2"><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

<script>
    // Function to add more link

    // Function to merge all links into a single comma-separated string before submitting
    function mergeLinks() {
        <?php foreach ($fields as $field) { ?>
        // For link1
        var link1Fields = document.getElementsByName("<?php echo $field['subtopic_name']; ?>_links1[]");
        var links1Array = [];
        for (var i = 0; i < link1Fields.length; i++) {
            if (link1Fields[i].value.trim() !== "") {
                links1Array.push(link1Fields[i].value.trim());
            }
        }
        var mergedLinks1 = links1Array.join(',');
        var hiddenInput1 = document.createElement('input');
        hiddenInput1.type = 'hidden';
        hiddenInput1.name = "<?php echo $field['subtopic_name']; ?>_link1";
        hiddenInput1.value = mergedLinks1;
        document.forms[0].appendChild(hiddenInput1);

        // For link2
        var link2Fields = document.getElementsByName("<?php echo $field['subtopic_name']; ?>_links2[]");
        var links2Array = [];
        for (var i = 0; i < link2Fields.length; i++) {
            if (link2Fields[i].value.trim() !== "") {
                links2Array.push(link2Fields[i].value.trim());
            }
        }
        var mergedLinks2 = links2Array.join(',');
        var hiddenInput2 = document.createElement('input');
        hiddenInput2.type = 'hidden';
        hiddenInput2.name = "<?php echo $field['subtopic_name']; ?>_link2";
        hiddenInput2.value = mergedLinks2;
        document.forms[0].appendChild(hiddenInput2);

        // For link3
        var link3Fields = document.getElementsByName("<?php echo $field['subtopic_name']; ?>_links3[]");
        var links3Array = [];
        for (var i = 0; i < link3Fields.length; i++) {
            if (link3Fields[i].value.trim() !== "") {
                links3Array.push(link3Fields[i].value.trim());
            }
        }
        var mergedLinks3 = links3Array.join(',');
        var hiddenInput3 = document.createElement('input');
        hiddenInput3.type = 'hidden';
        hiddenInput3.name = "<?php echo $field['subtopic_name']; ?>_link3";
        hiddenInput3.value = mergedLinks3;
        document.forms[0].appendChild(hiddenInput3);
        <?php } ?>
    }
</script>

</html>
