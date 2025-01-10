<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fetch_content.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <title>Subtopics Table</title>
    <style>
        .div-rating {
            position: relative;
        }

        .div-rating::after {
            content: attr(data-tooltip);
            max-width: 200px;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-200%);
            background-color: #333;
            color: #ff9900;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            margin-left: 65px;
            font-weight: bold;
        }

        .div-rating:hover::after {
            visibility: visible;
            opacity: 1;
        }

        .spandesc {
            position: relative;
            margin-left: 10px;
            font-weight: bold;
            color: blue;
            cursor: pointer;
        }




        .spandesc::after {
            content: attr(data-tooltip);
            min-width: 200px;
            max-width: 600px;
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 1;
            word-wrap: break-word;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
        }

        .spandesc:hover::after {
            visibility: visible;
            opacity: 1;
        }

        .spandesc[data-tooltip]:hover::after {
            left: -40px;
            right: 0;
            transform: translateX(0);
            margin-right: 10px;
            white-space: normal;
        }

        @media screen and (max-width: 768px) {
            .spandesc::after {
                max-width: 90%;
                font-size: 10px;
                left: 50%;
                transform: translateX(-50%);
            }
        }

        @media screen and (max-width: 480px) {
            .spandesc::after {
                max-width: 80%;
                font-size: 9px;
                padding: 8px;
            }
        }

        .link-div {
            margin-bottom: 5px;
            margin-left: auto;
            /* margin-left: -20px; */

        }

        .classtitle {
            text-align: left;
            border-left: hidden;
        }

        /* Container for the truncated text */
        .title-container {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
            /* Adjust as needed */
            position: relative;
        }

        .title-container {
            overflow: visible;
        }

        .truncated-title {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            min-width: 200px;
            max-width: 500px;
            position: relative;
            cursor: pointer;
            /* Add a pointer cursor to indicate a tooltip */
            z-index: 1;
            /* Add a z-index to ensure the tooltip appears on top */
        }

        .truncated-title::after {
            content: attr(data-tooltip);
            position: absolute;
            background-color: #333;
            /* Change the background color to a contrasting color */
            color: #fff;
            /* Change the text color to a contrasting color */
            padding: 8px;
            border-radius: 4px;
            white-space: normal;
            min-width: 200px;
            max-width: 600px;
            /* Adjust the tooltip width */
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            bottom: 100%;
            /* Position the tooltip above the element */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            /* Add a z-index to ensure the tooltip appears on top */
        }

        .truncated-title:hover::after {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <?php
    include '../../connection.php';

    $topic_name = $_POST['subtopic_name'];

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT * FROM topic WHERE subtopic_name = ?");
    $stmt->bind_param("s", $topic_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="subtopics-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th colspan="3">Basic Level</th>';
        echo '<th colspan="3">Intermediate Level</th>';
        echo '<th colspan="3">Advance Level</th>';
        echo '<th colspan="2">Local NPTEL</th>';
        echo '<th colspan="2">Live Video</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            // Decode JSON data safely
            $basic_links = json_decode($row['basic_links'], true) ?: [];
            $medium_links = json_decode($row['medium_links'], true) ?: [];
            $advanced_links = json_decode($row['advanced_links'], true) ?: [];

            $basic_titles = json_decode($row['basic_titles'], true) ?: [];
            $medium_titles = json_decode($row['medium_titles'], true) ?: [];
            $advanced_titles = json_decode($row['advanced_titles'], true) ?: [];

            $basic_descriptions = json_decode($row['basic_descriptions'], true) ?: [];
            $medium_descriptions = json_decode($row['medium_descriptions'], true) ?: [];
            $advanced_descriptions = json_decode($row['advanced_descriptions'], true) ?: [];

            $basic_ratings = json_decode($row['rating1'], true) ?: [];
            $medium_ratings = json_decode($row['rating2'], true) ?: [];
            $advanced_ratings = json_decode($row['rating3'], true) ?: [];

            // Store the links, titles, descriptions, and ratings in arrays for iteration
            $links_array = [$basic_links, $medium_links, $advanced_links];
            $titles_array = [$basic_titles, $medium_titles, $advanced_titles];
            $descriptions_array = [$basic_descriptions, $medium_descriptions, $advanced_descriptions];
            $ratings_array = [$basic_ratings, $medium_ratings, $advanced_ratings];

            echo '<tr>';
            for ($index = 0; $index < 3; $index++) {
                echo '<td class="table-link">';

                $links = $links_array[$index];
                $titles = $titles_array[$index];
                $descriptions = $descriptions_array[$index];
                $ratings = $ratings_array[$index];

                // Display links and descriptions
                foreach ($links as $link_index => $link) {
                    $full_description = isset($descriptions[$link_index]) ? htmlspecialchars($descriptions[$link_index]) : '';

                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))(?<video_id>[\w-]+)/', $link, $match)) {
                        $video_id = $match['video_id']; // Store video ID
                        echo '<div class="link-div">';
                        echo '<span class="spandesc" data-tooltip="' . $full_description . '">';
                        echo '<a href="#" onclick="openVideoModal(\'' . $video_id . '\'); return false;" class="video-link">';
                        echo '<img src="../../image/youtube.jpg" alt="Play Video" style="width: 25px; height: 20px; margin-left: -20px;">';
                        echo '</a>';
                        echo '</span>';
                        echo '</div>';
                    } else {
                        echo '<div class="link-div">';
                        echo '<span class="spandesc" data-tooltip="' . $full_description . '">';
                        echo '<a href="' . htmlspecialchars($link) . '" target="_blank" class="video-link">';
                        echo '<img src="../../image/copywriting.jpg" alt="Visit Website" style="width: 30px; height: 25px; margin-left:-20px">';
                        echo '</a>';
                        echo '</span>';
                        echo '</div>';
                    }
                }
                echo '</td>';

                // Display titles
                echo '<td class="classtitle" style="width: 120px;">';
                foreach ($titles as $title) {
                    $full_title = htmlspecialchars($title); // Escape the full title for safe HTML output
                    echo '<div class="title-container">';

                    // Display only the truncated version of the title with a tooltip for the full content
                    echo '<span class="truncated-title" data-tooltip="' . $full_title . '">' . mb_strimwidth($full_title, 0, 20, '...') . '</span>';
                    
                    echo '</div>';
                }
                echo '</td>';





                // Display ratings
                echo '<td class="rat">';

                if (is_array($ratings)) {
                    foreach ($ratings as $rating) {
                        $full_stars = floor($rating);
                        $partial_star = round(($rating - $full_stars) * 100);
                        echo '<span class="rating">';
                        echo '<div class="div-rating" data-tooltip="' . number_format($rating, 1) . '/5">';
                        for ($j = 0; $j < 5; $j++) {
                            if ($j < $full_stars) {
                                echo '<i class="fas fa-star"></i>';
                            } elseif ($j == $full_stars && $partial_star > 50) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            } else {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                        echo '</div>';
                        echo '</span><br>';
                    }
                } else {
                    echo '<span class="rating">No rating available</span>';
                }

                // // Create a form for adding a new rating
// echo '<form action="submit_rating.php" method="post" class="rating-form">';
    
                // // Assuming you have a unique ID for each item in the database
// echo '<input type="hidden" name="item_id" value="' . $row['id'] . '">';
    
                // // Rating selection (1 to 5 stars)
// echo '<div class="star-rating">';
// for ($r = 5; $r >= 1; $r--) {
//     echo '<input type="radio" name="new_rating" value="' . $r . '" id="star-' . $r . '-' . $i . '">';
//     echo '<label for="star-' . $r . '-' . $i . '">&#9733;</label>';
// }
// echo '</div>';
    
                // // Submit button
// echo '<input type="submit" value="Rate">';
    
                // echo '</form>';
                echo '</td>';
            }

            // NPTEL Video and Rating Form
            echo '<td>NPTEL Video</td>';
            echo '<td class="ratclass">';
            echo '<form action="rate_video.php" method="post" class="ratclass">';
            echo '<div class="rating-tooltip">';
            include 'tooltip_rating.php';
            echo '<div class="star-rating">';
            for ($r = 5; $r >= 1; $r--) {
                echo '<input type="radio" name="rating" value="' . $r . '" id="star-' . $r . '-nptel-' . $i . '">';
                echo '<label for="star-' . $r . '-nptel-' . $i . '">&#9733;</label>';
            }
            echo '</div>';
            echo '</div>';

            echo '<br><input type="submit" value="Rate">';
            echo '</form>';
            echo '</td>';

            // Live Video
            echo '<td><a href="http://192.168.68.10:9080/tv">';
            echo '<img src="../../image/live-icon.png" alt="Visit Website" style="width: 45px; height: 42px;">';
            echo '</a></td>';
            echo '<td class="ratclass">';
            echo '<form action="rate_video.php" method="post" class="ratclass">';
            echo '<div class="rating-tooltip">';
            include 'tooltip_rating.php';
            echo '<div class="star-rating">';
            for ($r = 5; $r >= 1; $r--) {
                echo '<input type="radio" name="rating" value="' . $r . '" id="star-' . $r . '-live-' . $i . '">';
                echo '<label for="star-' . $r . '-live-' . $i . '">&#9733;</label>';
            }
            echo '</div>';
            echo '</div>';
            echo '<br><input type="submit" value="Rate">';
            echo '</form>';
            echo '</td>';

            echo '</tr>';
            $i++;
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No subtopics found.";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>

</html>
