<?php

session_start();

require_once '../database class/Database.class.php';
require_once '../database class/GetUser.class.php';
require_once '../database class/GetOrders.class.php';


$orders = new Orders();
$orders = $orders->getOrders($_SESSION["user_id"]);
$users = new Users();
$user = $users->getUser($_SESSION["user_id"]);
$userInfo = $users->getUserInfo($_SESSION["user_id"]);

// check if the user is login
if (!isset($_SESSION["user_id"])) {
    header("Location: Login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Profile</title>
</head>

<body>
    <?php require_once '../include/Nav.php' ?>
    <h1 class="title">Profile</h1>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">User Info</h5>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">User ID</th>
                                    <th scope="col">Name</th>
                                    <?php if (isset($userInfo['driverLicense'])) { ?>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Birth Date</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Zip Code</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $user['user_id'] ?></td>
                                    <td>
                                        <?php if (isset($userInfo['name'])) {
                                            echo $userInfo['name'];
                                        } else {
                                            echo $user['user_name'];
                                        } ?>
                                    </td>
                                    <?php if (isset($userInfo['driverLicense'])) { ?>
                                        <td><?= $userInfo['phone_number'] ?></td>
                                        <td><?= $userInfo['birth_date'] ?></td>
                                        <td><?= $userInfo['address'] ?></td>
                                        <td><?= $userInfo['zip_code'] ?></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- orders -->
        <?php if ($orders) { ?>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <h5 class="card-header">Orders</h5>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?= $orders['order_id'] ?></th>
                                        <td><?= $orders['startDate'] ?></td>
                                        <td><?= $orders['endDate'] ?></td>
                                        <td><?= $orders['comment'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php require_once '../include/Footer.php' ?>
</body>

</html>