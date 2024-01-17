<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}

require_once '../../database class/Database.class.php';
require_once '../../database class/GetOrders.class.php';

$orders = new Orders();
$orders = $orders->getOrders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Orders</title>
</head>

<body>
    <a href="javascript:history.back()">
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
    </a>
    <h1 class="title">Orders</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="table-dark">
                <th scope="col">Order ID</th>
                <th scope="col">Client ID</th>
                <th scope="col">Car id</th>
                <th scope="col">Rent/Buy</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Usage</th>
                <th scope="col">Comment</th>
                <th scope="col">Order Date</th>
                <th scope="col">Paid</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr class="table-light">
                    <td><?= $order['order_id'] ?></td>
                    <td><a href="Custumer.php?id=<?= $order['user_id'] ?>" class="text-decoration-none text-dark"><?= $order['user_id'] ?></a></td>
                    <td><a href="EditCar.php?id=<?= $order['car_id'] ?>" class="text-decoration-none text-dark"><?= $order['car_id'] ?></a></td>
                    <td><?= $order['rent_buy'] ?></td>
                    <td><?= $order['startDate'] ?></td>
                    <td><?= $order['endDate'] ?></td>
                    <td><?= $order['take'] ?></td>
                    <td><?= $order['comment'] ?></td>
                    <td><?= $order['orderDate'] ?></td>
                    <td><?= $order['paid'] ?></td>
                    <td><a href="DeleteOrder.php?id=<?= $order['order_id'] ?>&user_id=<?= $order['user_id'] ?>" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>