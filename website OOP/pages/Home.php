<?php
session_start();

require_once "../database class/Database.class.php";
require_once "../database class/GetCars.class.php";

$car = new Cars();
$cars = $car->getCars(null, "rent");

$calculate = isset($_POST['calculate']) ? true : false;
if ($calculate) {
    $car_id = $_POST['cars'];
    $rent_date = $_POST['rent_date'];
    $return_date = $_POST['return_date'];

    $calculate = $car->getCars($car_id);
    $price = $calculate['Price'];

    $start_date = new DateTime($rent_date);
    $end_date = new DateTime($return_date);

    $interval = $start_date->diff($end_date);

    $total_price = $price * $interval->days;
}

if (isset($_POST['search'])) {
    $input = htmlspecialchars($_POST['input']);

    $searchCars = $car->search($input);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home</title>
</head>

<body class="body">
    <?php include '../include/Nav.php'; ?>

    <div class="slide">
        <div class="animation head">
            <h1>Welcome</h1>
            <img src="../assets/img/background-car.jpg">
        </div>

        <!-- Calculater -->
        <div class="animation calculater">
            <h1>Calculate The Rent</h1>
            <form method="post" class="calculater-form">
                <div class="form-group">
                    <select name="cars" id="cars">
                        <!-- select from the database -->
                        <?php foreach ($cars as $car) { ?>
                            <option value="<?php echo $car['car_id']; ?>"><?php echo $car['Brand']; ?></option>
                        <?php } ?>
                    </select>

                    <label for="start">Start:</label>
                    <input type="date" name="rent_date" id="start">
                    <label for="end">End:</label>
                    <input type="date" name="return_date" id="end">
                    <button class="calculate" name="calculate">Calculate</button>
                </div>
                <div>
                    <?php if (isset($total_price)) { ?>
                        <h1 type="number" name="total" id="total">€<?php echo $total_price ?></h1>
                    <?php } ?>
                </div>
            </form>
        </div>

        <!-- Search -->
        <div class="animation search">
            <h1>Search</h1>
            <form method="post">
                <div class="search-box">
                    <button name="search" class="btn-search"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                    <input type="text" class="input-search" name="input" placeholder="Search for Vehicle...">
                </div>
            </form>
            <!-- Result -->
            <div class="result">
                <?php if (isset($searchCars)) {
                    foreach ($searchCars as $car) { ?>
                        <div class="car">
                            <h1><?php echo $car['Brand']; ?></h1>
                            <h1>Price: €<?php echo $car['Price']; ?></h1>
                            <img src="../assets/img/<?php echo $car['car_image']; ?>">
                            <a href="VehicleDetail.php?id=<?php echo $car['car_id']; ?>"><button>View Details</button></a>
                        </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>

    <?php include '../include/Footer.php'; ?>
    <script src="../assets/js/script.js"></script>
</body>

</html>