<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}
require_once '../../database class/Database.class.php';
require_once '../../database class/GetCars.class.php';
require_once '../../database class/Edit.class.php';

$id = $_GET['car_id'];
$getCars = new Cars;
$car = $getCars->getCars($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = htmlspecialchars(isset($_POST['brand']) ? $_POST['brand'] : "");
    $model = htmlspecialchars(isset($_POST['model']) ? $_POST['model'] : "");
    $year = htmlspecialchars(isset($_POST['year']) ? $_POST['year'] : "");
    $license = htmlspecialchars(isset($_POST['licenseplate']) ? $_POST['licenseplate'] : "");
    $price = htmlspecialchars(isset($_POST['price']) ? $_POST['price'] : "");
    $availability = isset($_POST['availability']) ? "yes" : "no";
    $rent_buy = htmlspecialchars(isset($_POST['rent_buy']) ? $_POST['rent_buy'] : "");
    $edit = new Edit;
    try {
        $edit->editCar($id, $brand, $model, $year, $license, $price, $availability, $rent_buy);
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Edit</title>
</head>

<body>
    <a href="EditCar.php"><svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg></a>
    <h1 class="title">Edit Car</h1>
    <form action="" class="form-edit" method="post">
        <img src="../../assets/img/<?php echo $car["car_image"]; ?>">
        <div class="edit">
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" value="<?php echo $car["Brand"]; ?>">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" value="<?php echo $car["Model"]; ?>">
            <label for="year">Year</label>
            <input type="date" name="year" id="year" value="<?php echo $car["Year"]; ?>">
            <label for="licenseplate">License Plate</label>
            <input type="text" name="licenseplate" id="licenseplate" value="<?php echo $car["LicensePlate"]; ?>">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" value="<?php echo $car["Price"]; ?>">
            <label for="availability">Availability</label>
            <input type="checkbox" class="form-check" name="availability" id="availability" value="<?php echo $car["Availability"]; ?>" <?php echo ($car["Availability"] === "yes") ? 'checked' : ''; ?>>
            <label for="rent_buy">Rent/Buy</label>
            <select name="rent_buy" id="rent_buy">
                <option value="rent" <?php echo ($car["rent_buy"] === "rent") ? 'selected' : ''; ?>>Rent</option>
                <option value="buy" <?php echo ($car["rent_buy"] === "buy") ? 'selected' : ''; ?>>Buy</option>
            </select>
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Edit</button>
        </div>
    </form>
</body>

</html>