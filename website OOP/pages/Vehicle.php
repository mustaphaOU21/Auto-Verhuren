<?php
session_start();

require_once '../database class/Database.class.php';
require_once '../database class/GetCars.class.php';
require_once '../database class/GetUser.class.php';
require_once '../database class/AddCar.class.php';

$add = new AddCar();
$cars = new Cars();
$users = new Users();

$user = $users->getUser(isset($_SESSION["user_id"]));

$buy = isset($_GET['buy']) ? $_GET['buy'] : null;
$rent = isset($_GET['rent']) ? $_GET['rent'] : null;

// if the consumer clicks rent or buy then the query will be different
if ($buy == 'buy') {
    $results = $cars->getCars(null, 'buy');
} elseif ($rent == 'rent') {
    $results = $cars->getCars(null, 'rent');
} else {
    $results = $cars->getCars();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/vehicle.css">
    <title>Vehicle</title>
</head>

<body>
    <?php include '../include/Nav.php'; ?>
    <div class="vehicle">
        <div class="main">
            <h1>Vehicles</h1>
            <form method="get">
                <button name="buy" value="buy">BUY</button>
                <button name="rent" value="rent">RENT</button>
            </form>
        </div>
    </div>

    <div class="cars">
        <h1>Vehicles</h1>

        <div class="container">
            <?php foreach ($results as $result) { ?>
                <div class="card">
                    <!-- Heart -->
                    <a href="favorite.php?id=<?php echo $result['car_id']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                        </svg></a>

                    <img src="../assets/img/<?php echo $result['car_image']; ?>">
                    <h3><?php echo $result['Brand'] . ' ' . $result['Model']; ?></h3>
                    <div class="details">
                        <h3>€<?php echo $result['Price']; ?></h3>
                        <div class="buttons">
                            <a href="../pages/VehicleDetail.php?id=<?php echo $result['car_id']; ?>"><button>View Detail</button></a>

                            <?php if ($result["Availability"] == "yes") { ?>
                                <a href="../pages/Booking.php?id=<?php echo $result['car_id']; ?>&car=<?php echo $result['car_id']; ?>&available=<?php echo $result['Availability']; ?>">
                                    <button>
                                        <?php if ($result["rent_buy"] == "rent") {
                                            echo "Rent";
                                        } else {
                                            echo "Buy";
                                        } ?>
                                    </button>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include '../include/Footer.php'; ?>
    <script src="../assets/js/script.js"></script>
</body>

</html>