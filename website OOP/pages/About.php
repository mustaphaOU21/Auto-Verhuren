<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/About.css">
    <title>About us</title>
</head>

<body>
    <?php include '../include/nav.php'; ?>
    <h1 class="title">About us</h1>

    <div class="about">
        <div class="about-img">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2m-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11" />
            </svg>
        </div>
        <div class="about-text">
            <ul>
                <li>
                    <strong>Mustapha Ouassou</strong> The founder and CEO of our company,
                </li>
                <hr>
                <li>
                    <strong>John Doe: </strong>Our seasoned expert with
                    an unbridled love for cars, John brings
                    a wealth of knowledge and experience to our team.
                    He's our go-to person for all things mechanical and automotive.
                </li>
                <li>
                    <strong>Hannah Smith:</strong> A customer service extraordinaire,
                    Hannah ensures that every interaction with us is as smooth as
                    a finely-tuned engine. Her dedication to your satisfaction is unwavering.
                </li>
                <li>
                    <strong>Michael Johnson:</strong>Our team member who knows
                    how to keep up with the latest trends.
                    He's always on the lookout for new and exciting
                    cars to explore.
                </li>
            </ul>
        </div>
    </div>
    <?php include '../include/Footer.php'; ?>
</body>

</html>