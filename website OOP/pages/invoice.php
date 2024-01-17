<?php
session_start();

if (!isset($_SESSION["invoice"])) {
    header("Location: Vehicle.php");
    exit();
}
require_once '../database class/Database.class.php';
require_once '../database class/GetUser.class.php';
require_once '../database class/GetCars.class.php';
require_once '../database class/GetOrders.class.php';

$userId = $_SESSION["user_id"];
$orderId = $_SESSION["order_id"];

$users = new Users();
$user = $users->getUserInfo($userId);

$car = $_GET["car"];
$cars = new Cars();
$car = $cars->getCars($car);

$orders = new Orders();
$orders = $orders->getOrders($userId);

// calculate price
$price = $car["Price"];

$start_date = new DateTime($orders["startDate"]);
$end_date = new DateTime($orders["endDate"]);

$interval = $start_date->diff($end_date);

$total_price = $price * $interval->days;

unset($_SESSION["invoice"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Invoice.css">
    <title>Invoice</title>
</head>

<body>
    <button class="print" onclick="printPage()">Print</button>
    <!-- Invoice buy -->
    <?php if ($car["rent_buy"] == "buy") { ?>
        <div class="invoice">
            <h1>Invoice</h1>
            <div class="invoice-container">
                <div class="invoice-logo">
                    <img src="../assets/img/Logo.png">
                    <h1>Mustapha Shop</h1>
                </div>
                <div class="invoice-car">
                    <img src="../assets/img/<?php echo $car["car_image"] ?>">
                    <h1><?php echo $car["Brand"] ?></h1>
                    <h1><?php echo $orders["paid"] ?></h1>
                </div>
                <div class="invoice-info">
                    <h1>Driver's License</h1>
                    <div class="driverLicense">
                        <img src="../admin/assets/image/<?php echo $user["driverLicense"] ?>">

                        <table class="info-table">
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo $user["name"] ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo $user["phone_number"] ?></td>
                            </tr>
                            <tr>
                                <th>Birth Date</th>
                                <td><?php echo $user["birth_date"] ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $user["address"] ?></td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td><?php echo $user["zip_code"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="total">
                    <h1>Total: €<?php echo $car["Price"] ?></h1>
                </div>
            </div>
        </div>

        <!-- Invoice rent -->
    <?php } else if ($car["rent_buy"] == "rent") { ?>
        <div class="invoice">
            <h1>Invoice</h1>
            <div class="invoice-container">
                <div class="invoice-logo">
                    <img src="../assets/img/Logo.png">
                    <h1>Mustapha Shop</h1>
                </div>
                <div class="invoice-car">
                    <img src="../assets/img/<?php echo $car["car_image"] ?>">
                    <h1><?php echo $car["Brand"] ?></h1>
                    <h1><?php echo $orders["paid"] ?></h1>
                    <h1>Start Datum: <?php echo $orders["startDate"] ?></h1>
                    <h1>End Datum: <?php echo $orders["endDate"] ?></h1>
                </div>
                <div class="invoice-info">
                    <h1>Driver's License</h1>
                    <div class="driverLicense">
                        <img src="../admin/assets/image/<?php echo $user["driverLicense"] ?>">

                        <table class="info-table">
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo $user["name"] ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo $user["phone_number"] ?></td>
                            </tr>
                            <tr>
                                <th>Birth Date</th>
                                <td><?php echo $user["birth_date"] ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $user["address"] ?></td>
                            </tr>
                            <tr>
                                <th>Zip Code</th>
                                <td><?php echo $user["zip_code"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="total">
                    <h1>Total: €<?php echo $total_price ?></h1>
                </div>
            </div>
        </div>
    <?php } ?>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>