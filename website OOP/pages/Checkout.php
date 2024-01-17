<?php
session_start();
if (!isset($_GET["car"])) {
    header("Location: Vehicle.php");
}

require_once '../database class/Database.class.php';
require_once '../database class/GetCars.class.php';
require_once '../database class/AddCar.class.php';
require_once '../database class/GetUser.class.php';

$carId = isset($_GET["car"]) ? $_GET["car"] : null;

$cars = new Cars();
$car = $cars->getCars($carId);

$add = new AddCar();

// get user information
$users = new Users();
$user = $users->getUser($_SESSION["user_id"]);

if ($user["booked"] == "yes") {
    header("Location: Vehicle.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/CheckOut.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Checkout</title>
</head>

<body>
    <?php
    if (isset($add->message)) {
        echo $add->message;
    }
    ?>
    <?php if ($user["verify"] == "waiting") { ?>
        <div class="container mt-4">
            <a href="Home.php" class="text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="lightblue" class="bi bi-caret-left-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                    <path d="M10.205 12.456A.5.5 0 0 0 10.5 12V4a.5.5 0 0 0-.832-.374l-4.5 4a.5.5 0 0 0 0 .748l4.5 4a.5.5 0 0 0 .537.082" />
                </svg>
            </a>
            <h1 class="bg-warning p-3">Verify Driver License</h1>
            <p class="bg-light p-3">
                We are going to verify your driver's license. An email is being sent to our team, and you'll receive a response within 15 minutes.
            </p>
        </div>

    <?php exit();
    } else if ($user["verify"] == "valid" && $_SESSION["rent_buy"] == "rent") { ?>
        <?php
        if (isset($_POST["checkout"])) {
            $user = $_SESSION["user_id"];
            $start = htmlspecialchars($_POST["start"]);
            $end = htmlspecialchars($_POST["end"]);
            $message = htmlspecialchars($_POST["message"]);
            $order_date = date("Y-m-d");
            $payment = htmlspecialchars($_POST["payment"]);
            $payment != "later" ? $paid = "Has paid" : $paid = "Has not paid yet";

            $add = new AddCar();
            $add->Order($user, $carId, $_SESSION["rent_buy"], $start, $end, $message, $order_date, $paid);
        }
        ?>
        <div class="checkout">
            <h1>Checkout</h1>
            <div>
                <div class="car">
                    <img src="../assets/img/<?php echo $car["car_image"]; ?>" alt="car">
                    <h3><?php echo $car["Brand"]; ?></h3>
                    <h3>€<?php echo $car["Price"]; ?> per day</h3>
                </div>
                <form method="post">
                    <label for="start">Start: <input type="date" name="start"></label>
                    <label for="end">End: <input type="date" name="end"></label>
                    <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                    <select name="payment">
                        <option value="later">Pay In The Store</option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="paypal">Paypal</option>
                    </select>
                    <button name="checkout">Checkout</button>
                </form>
            </div>
        </div>
    <?php } else if ($user["verify"] == "valid" && $_SESSION["rent_buy"] == "buy") {
        if (isset($_POST["checkout"])) {
            $user = $_SESSION["user_id"];
            $message = htmlspecialchars($_POST["message"]);
            $order_date = date("Y-m-d");
            $payment = htmlspecialchars($_POST["payment"]);
            $payment != "later" ? $paid = "Has paid" : $paid = "Has not paid yet";

            $add = new AddCar();
            $add->Order($user, $carId, $_SESSION["rent_buy"], null, null, $message, $order_date, $paid);
        }
    ?>
        <div class="checkout">
            <h1>Checkout</h1>
            <div>
                <div class="car">
                    <img src="../assets/img/<?php echo $car["car_image"]; ?>" alt="car">
                    <h3><?php echo $car["Brand"]; ?></h3>
                    <h3>€<?php echo $car["Price"]; ?> per day</h3>
                </div>
                <form method="post">
                    <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                    <select name="payment">
                        <option value="later">Pay In The Store</option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="paypal">Paypal</option>
                    </select>
                    <button name="checkout">Checkout</button>
                </form>
            </div>
        </div>
    <?php } ?>
</body>

</html>