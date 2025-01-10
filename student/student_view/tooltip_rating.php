<?php
include '../../connection.php';

// Get video_id and subtopic_id
$video_id = 0; // Example video ID (you can pass it via GET/POST)
$subtopic_id = 41; // Example subtopic ID

$query = $conn->prepare("SELECT 
    SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS one_star,
    SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS two_star,
    SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS three_star,
    SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS four_star,
    SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS five_star
    FROM ratings
    WHERE video_id = ? AND subtopic_id = ?");
$query->bind_param("ii", $video_id, $subtopic_id);
$query->execute();
$rating = $query->get_result()->fetch_assoc();

// Calculate total ratings
$total_ratings = array_sum($rating);

// Avoid division by zero
if ($total_ratings > 0) {
    $rating_percentages = [
        '5_star' => ($rating['five_star'] / $total_ratings) * 100,
        '4_star' => ($rating['four_star'] / $total_ratings) * 100,
        '3_star' => ($rating['three_star'] / $total_ratings) * 100,
        '2_star' => ($rating['two_star'] / $total_ratings) * 100,
        '1_star' => ($rating['one_star'] / $total_ratings) * 100,
    ];
} else {
    $rating_percentages = ['5_star' => 0, '4_star' => 0, '3_star' => 0, '2_star' => 0, '1_star' => 0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Tooltip</title>
    <style ?v=<?php echo time(); ?>>
        .rating-tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .rating-tooltip .tooltip-content {
            visibility: hidden;
            width: 250px;
            background-color: #333;
            color: #fff;
            text-align: left;
            border-radius: 5px;
            padding: 15px;
            position: absolute;
            z-index: 1;
            bottom: 120%;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 12px;
            margin-left: 120px;
            margin-right: 120px;
            margin-bottom: 25px;
        }

        .rating-tooltip:hover .tooltip-content {
            visibility: visible;
        }

        .rating-bar-container {
            display: flex;
            flex-direction: column;
        }

        .rating-bar {
            background-color: #555;
            width: 100%;
            height: 8px;
            border-radius: 5px;
            margin: 5px 0;
            position: relative;
        }

        .rating-bar .filled {
            height: 8px;
            border-radius: 5px;
            background-color: #ff9900;
        }

        .rating-count {
            display: inline-block;
            margin-left: 10px;
            color: #ddd;
        }

        .rating-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="rating-tooltip">
        <div class="tooltip-content">
            <div class="rating-bar-container">
                <div class="rating-title">
                <span>5 Stars</span>
                    <span class="rating-count"><?= $rating['five_star'] ?> reviews</span>
                    
                </div>
                <div class="rating-bar">
                    <div class="filled" style="width: <?= $rating_percentages['5_star'] ?>%;"></div>
                </div>

                <div class="rating-title">
                <span>4 Stars</span>
                    <span class="rating-count"><?= $rating['four_star'] ?> reviews</span>
                    
                </div>
                <div class="rating-bar">
                    <div class="filled" style="width: <?= $rating_percentages['4_star'] ?>%;"></div>
                </div>

                <div class="rating-title">
                <span>3 Stars</span>
                    <span class="rating-count"><?= $rating['three_star'] ?> reviews</span>
                    
                </div>
                <div class="rating-bar">
                    <div class="filled" style="width: <?= $rating_percentages['3_star'] ?>%;"></div>
                </div>

                <div class="rating-title">
                <span>2 Stars</span>
                    <span class="rating-count"><?= $rating['two_star'] ?> reviews</span>
                   
                </div>
                <div class="rating-bar">
                    <div class="filled" style="width: <?= $rating_percentages['2_star'] ?>%;"></div>
                </div>

                <div class="rating-title">
                <span>1 Star</span>
                    <span class="rating-count"><?= $rating['one_star'] ?> reviews</span>
                    
                </div>
                <div class="rating-bar">
                    <div class="filled" style="width: <?= $rating_percentages['1_star'] ?>%;"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>