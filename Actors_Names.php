<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Actors</title>
    <style>
        body {
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #76ABAE;
            margin: 0;
            padding: 0;

        }

        .container {
            max-width: 800px;
            margin: 70px auto;
            padding: 20px;
            background-color: #EEEEEE;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #222831;
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            padding: 0;
            list-style-type: none;
        }

        li {
            border-radius: 10px;
            background-color: #fff;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 10px;
            justify-content: center;
            align-items: center;
            box-shadow: 0 20px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        li:hover {
            background-color: #f0f0f0;
        }

        p {
            color: #888;
            font-style: italic;
            text-align: center;
        }

    </style>
</head>
<body>
<?php include 'Header.php'; ?>

<div class="container">
    <?php

    session_start();

    // Display actors born in the date user have entered

    echo '<h2>Actors Born on ' . date('F j, Y', strtotime($_SESSION['birthdate'])) . '</h2>';

    if (!empty($_SESSION['actorsNamesArray'])) {
        echo '<ul>';
        foreach ($_SESSION['actorsNamesArray'] as $actorName) {
            echo '<li>' . $actorName . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No Actors Found.</p>';
    }
    ?>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
