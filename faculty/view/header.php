<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>faculty header</title>
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .header{
            background-color: #9071be;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="../../image/LOGO_change.jpg" alt="">
        </div>
        <ul class="nav">
            <li><a href="facultyindex.php">Home</a></li>
            <li><a href="addcourse.php">Add Course</a></li>
            <li><a href="update.php">Update Course</a></li>
            <li><a href="view.php">View Course</a></li>
            <li><a href="../../registration/logout.php" id="logout-btn">Logout</a></li>
        </ul>
    </div>
</body>
</html>
