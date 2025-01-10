<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Header</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        /* Custom header styling */
        .header {
            background-color: #9071be;
            padding: 10px 0;
        }

        .header .logo img {
            max-height: 50px;
        }

        .header .nav {
            margin-left: auto;
            margin-right: auto;
        }

        .header .nav li {
            list-style: none;
            display: inline;
            margin: 0 10px;
        }

        .header .nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
        }

        .header .nav a:hover {
            background-color: #a678d6;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo section -->
                <div class="col-md-3">
                    <div class="logo">
                        <img src="../../image/LOGO_change.jpg" alt="Logo">
                    </div>
                </div>
                <!-- Navigation Menu -->
                <div class="col-md-9">
                    <ul class="nav justify-content-end">
                        <li><a href="./studentindex.php">Home</a></li>
                        <li><a href="./explore_material.php">Explore Material</a></li>
                        <li><a href="#">#</a></li>
                        <li><a href="./view_courses.php">View Course</a></li>
                        <li><a href="../../registration/logout.php" id="logout-btn">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, for any JS functionality in the header) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIKbTp8mJ7e6+Rr6uK2hb5fQZthFJ3/rK0XE0Xj69Y9s4tpLVp/2g4p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1+b2QfhW4H1t8XZyBG74hhD35zT2nri3joaQUjRs1Vx9IW0F9zIZh4p" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQ8i0D1aQ8U3DdPbIep9xK1K6b2M9yQkYI7p5I" crossorigin="anonymous"></script>

</body>
</html>
