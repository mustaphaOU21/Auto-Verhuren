<?php
session_start();

require_once '../database class/Database.class.php';
require_once '../database class/GetCars.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: Vehicle.php');
$cars = new Cars();
$car = $cars->getCars($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/vehicle.css">
    <title>Vehicle Detail</title>
</head>

<body>
    <?php include '../include/Nav.php'; ?>

    <h1 class="title">Vehicle Details</h1>
    <div class="detail">
        <img src="../assets/img/<?php echo $car['car_image']; ?>">

        <div class="details">
            <h3><Strong style="color: #6c66ad;">Brand: </Strong><?php echo $car['Brand']; ?></h3>
            <h3><Strong style="color: #6c66ad;">Model: </Strong><?php echo $car['Model']; ?></h3>
            <h3><Strong style="color: #6c66ad;">Year: </Strong><?php echo $car['Year']; ?></h3>
            <h3><Strong style="color: #6c66ad;">Price: </Strong>€<?php echo $car['Price']; ?></h3>
            <h3 class="license"><Strong style="color: #6c66ad;">LicencePlate: </Strong>
                <div class="licenseplate">
                    <img src="../assets/img/kentekenplaat.png">
                    <h3><?php echo $car['LicensePlate']; ?></h3>
                </div>
            </h3>
            <?php if ($car["Availability"] == "yes") { ?>
                <a href="../pages/Booking.php?id=<?php echo $car['car_id']; ?>&car=<?php echo $car['car_id']; ?>">
                    <button>
                        <?php if ($car["rent_buy"] == "rent") {
                            echo "Rent";
                        } else {
                            echo "Buy";
                        } ?>
                    </button>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php include '../include/Footer.php'; ?>
</body>

</html>