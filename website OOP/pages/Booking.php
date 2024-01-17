<?php
session_start();
// check if the user is login an has select a car to rent or buy. If not, redirect to login page or vehicle page
require_once '../database class/Database.class.php';
require_once '../database class/AddCar.class.php';
require_once '../database class/GetUser.class.php';
require_once '../database class/GetCars.class.php';

$cars = new Cars();
$car = $cars->getCars($_GET["id"]);
$users = new Users();
$user = $users->getUser($_SESSION["user_id"]);
// check if the user is login an has select a car to rent or buy. If not, redirect to login page or vehicle page
if (!isset($_SESSION["user_id"])) {
    header("Location: Login.php");
    exit();
} else if (!isset($_GET["id"]) || !isset($_GET["car"])) {
    header("Location: Vehicle.php");
    exit();
} else if (!isset($_GET["available"]) || $_GET["available"] != "yes") {
    header("Location: Sorry.php");
    exit();
} else if ($user["verify"] == "valid") {
    $_SESSION["rent_buy"] = $car["rent_buy"];
    header("Location: Checkout.php?car=" . $_GET["id"]);
    exit();
} else if ($user["verify"] == "waiting") {
    $_SESSION["message"] = "We need to verify your Driver License first then you can book your car.";
    header("Location: validation.php");
    exit();
} else if ($user["verify"] == "invalid") {
    $_SESSION["message"] = "You account is verified and banned. Please contact our support team.";
    header("Location: validation.php");
    exit();
}

// check if the form is submitted
if (isset($_POST["send"])) {
    $user_id = $_SESSION["user_id"];
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $birth_date = htmlspecialchars($_POST["birth_date"]);
    $address = htmlspecialchars($_POST["address"]);
    $zipCode = htmlspecialchars($_POST["zip_code"]);
    $state = htmlspecialchars($_POST["state"]);
    $car = htmlspecialchars($_GET["car"]);

    if (!empty($name) && !empty($phone) && !empty($birth_date) && !empty($address) && !empty($zipCode) && !empty($state)) {

        $image = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];
        $image_size = $_FILES['photo']['size'];
        $image_error = $_FILES['photo']['error'];

        $imageExt = explode('.', $image);
        $imageActExt = strtolower(end($imageExt));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($imageActExt, $allowed)) {
            if ($image_error === 0) {
                if ($image_size <= 1000000) {
                    $imageNew = uniqid('', true) . "." . $imageActExt;
                    $add = new AddCar();
                    $add->booking($user_id, $car, $name, $phone, $birth_date, $address, $zipCode, $imageNew, $image_tmp);
                } else {
                    $message = "Your file is too large!";
                }
            } else {
                $message = "There was an error uploading your image!";
            }
        } else {
            $message = "You can not upload file of this type!";
        }
    } else {
        $message = "All fields are required";
    }
}
// Client id
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/vehicle.css">
    <title>Booking</title>
</head>

<body>
    <h1 class="title">Booking</h1>
    <form method="post" class="booking_form" enctype="multipart/form-data">
        <div class="info_form">
            <?php
            // show error message
            if (isset($message)) {
                echo "<h1 style='color:red'>" . $message . "</h1>";
            }
            ?>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" placeholder="Enter your phone" required>

            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" placeholder="Enter your birth date" required>

            <label for="drivers_license_number">Drivers License Photo:</label>
            <input type="file" id="drivers_license_number" name="photo" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required>

            <label for="zip_code">Zip Code:</label>
            <input type="text" id="zip_code" name="zip_code" placeholder="Enter your zip code" required>

            <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="Enter your state" required>
            <br>
            <input type="submit" name="send" value="Submit">
        </div>
    </form>
</body>

</html>