<?php
session_start();

require_once '../database class/Database.class.php';
require_once '../database class/GetUser.class.php';

$users = new Users();
$user = $users->getUser($_SESSION["user_id"]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Validation.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Validation</title>
</head>

<body>
    <?php include("../include/Nav.php"); ?>
    <h1 class="title">Validation</h1>
    <?php if (isset($_SESSION["message"])) {
        echo "<h1 class='message'>" . $_SESSION["message"] . "</h1>";
    }
    unset($_SESSION["message"]);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Name</th>
                <th>Validation</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $user["user_id"]; ?></td>
                <td><?php echo $user["user_name"]; ?></td>
                <td>
                    <?php if ($user["verify"] == "valid") { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-lg text-success" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                        </svg>
                    <?php } else if ($user["verify"] == "invalid") { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-ban text-danger" viewBox="0 0 16 16">
                            <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                        </svg>
                    <?php } else { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-hourglass-split text-warning" viewBox="0 0 16 16">
                            <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                        </svg>
                    <?php } ?>
                </td>
                <td>
                    <h4><?php echo $user["Comment"]; ?></h4>
                </td>
            </tr>
        </tbody>
    </table>
    <?php include("../include/Footer.php"); ?>

</body>

</html>