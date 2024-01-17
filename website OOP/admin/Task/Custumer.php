<?php
session_start();

if ($_SESSION["user_type"] != "admin") {
    header("Location: ../../pages/Home.php");
    exit();
}

require_once '../../database class/Database.class.php';
require_once '../../database class/GetUser.class.php';

$users = new Users();
$user = $users->getUser(null, "admin");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Customer</title>
</head>

<body>
    <a href="../Home.php"><svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg></a>
    <h1 class="title">Customer</h1>
    <form method="post">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col ">Client ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Booked</th>
                    <th scope="col">Verify</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php foreach ($user as $user) : ?>
                <tbody>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>"><?= $user["user_id"] ?></td>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>"><?= $user["user_name"] ?></td>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>"><?= $user["user_email"] ?></td>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>">
                        <?php if ($user["booked"] == "yes") { ?>
                            <a href="Orders.php?id=<?= $user["user_id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="green" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                </svg></a>
                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="gray" class="bi bi-bookmark-dash-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5M6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                            </svg>
                        <?php } ?>
                    </td>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>">
                        <?php if ($user["verify"] == "valid") { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-lg text-success" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                            </svg>
                        <?php } else if ($user["verify"] == "invalid") { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-ban text-danger" viewBox="0 0 16 16">
                                <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                            </svg>
                        <?php } else if ($user["verify"] == "waiting") { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-hourglass-split text-warning" viewBox="0 0 16 16">
                                <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                            </svg>
                        <?php } ?>
                    </td>
                    <td class="<?php if (isset($_GET['id']) && $_GET['id'] == $user["user_id"]) { ?>bg-primary-subtle<?php } ?>">
                        <?php if ($user["verify"] != null) { ?>
                            <a href="InfoUser.php?userId=<?php echo $user["user_id"]; ?>"><button type="button" name="info" class="btn btn-primary btn-sm">Info</button></a>
                        <?php } else { ?>
                            <button type="button" name="info" class="btn btn-primary btn-sm">No Info</button>
                        <?php } ?>
                        <a href="DeleteUser.php?userId=<?php echo $user["user_id"]; ?>"><button type="button" name="delete" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Delete</button></a>
                    </td>
                </tbody>
            <?php endforeach ?>
    </form>
    <script>
        // if the admin want to delete a user get a pop up to confirm
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</body>

</html>