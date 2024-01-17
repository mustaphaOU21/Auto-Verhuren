<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}

require_once '../../database class/Database.class.php';
require_once '../../database class/GetUser.class.php';

$userId = $_GET['userId'];

$user = new Users();
$user = $user->getUserInfo($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <title>UserInfo</title>
</head>

<body>
    <a href="javascript:history.back()">
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
    </a>
    <h1 class="title">User Info</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">User ID</th>
                <th scope="col">Name</th>
                <th scope="col">Driver License</th>
                <th scope="col">Phone</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Address</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Booked</th>
                <th scope="col">Verified</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-light">
                <th><?= $user['id'] ?></th>
                <th><?= $user['user_id'] ?></th>
                <th class="driver"><img src="../assets/image/<?= $user['driverLicense']; ?>" class="img-thumbnail w-25"></th>
                <th><?= $user['name'] ?></th>
                <th><?= $user['phone_number'] ?></th>
                <th><?= $user['birth_date'] ?></th>
                <th><?= $user['address'] ?></th>
                <th><?= $user['zip_code'] ?></th>
                <th><?= $user['booked'] ?></th>
                <th>
                    <?php if ($user["verify"] == "valid") { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-lg text-success" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                        </svg>
                    <?php } else if ($user["verify"] == "invalid") { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-ban text-danger" viewBox="0 0 16 16">
                            <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                        </svg>
                    <?php } else if ($user["verify"] == "waiting") { ?>
                        <a href="Verify.php?userId=<?= $user['user_id'] ?>&verify=valid" class="btn">
                            <button class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-check-lg text-success" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                </svg>
                            </button>
                        </a>
                        <a href="Verify.php?userId=<?= $user['user_id'] ?>&verify=invalid" class="btn">
                            <button class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-ban text-danger" viewBox="0 0 16 16">
                                    <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                </svg>
                            </button>
                        </a>
                    <?php } ?>
                </th>
            </tr>
        </tbody>
</body>

</html>