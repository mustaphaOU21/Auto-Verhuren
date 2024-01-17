<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
}
require_once '../../database class/Database.class.php';
require_once '../../database class/AddCar.class.php';

if (isset($_POST['add'])) {
    $db = new AddCar();

    $brand = htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : "");
    $model = htmlspecialchars(isset($_POST['model']) ? $_POST['model'] : "");
    $year = htmlspecialchars(isset($_POST['builyear']) ? $_POST['builyear'] : "");
    $license = htmlspecialchars(isset($_POST['licensePlate']) ? $_POST['licensePlate'] : "");
    $price = htmlspecialchars(isset($_POST['price']) ? $_POST['price'] : "");
    $availability = isset($_POST['availability']) ? "yes" : "no";
    $rent_buy = htmlspecialchars(isset($_POST['rent_buy']) ? $_POST['rent_buy'] : "");

    $image = $_FILES['file']['name'];
    $image_tmp = $_FILES['file']['tmp_name'];
    $image_size = $_FILES['file']['size'];
    $image_error = $_FILES['file']['error'];

    $imageExt = explode('.', $image);
    $imageActExt = strtolower(end($imageExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($imageActExt, $allowed)) {
        if ($image_error === 0) {
            if ($image_size <= 1000000) { // Adjusted the condition for file size
                $imageNew = uniqid('', true) . "." . $imageActExt;
                if (strlen($license) <= 8) {
                    $db->addCar($brand, $model, $year, $license, $price, $imageNew, $availability, $rent_buy, $image_tmp);
                } else {
                    $message = "License plate should be less than 8 characters";
                }
            } else {
                $message = "Your file is too large!";
            }
        } else {
            $message = "There was an error uploading your image!";
        }
    } else {
        $message = "You can not upload file of this type!";
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
    <title>Add Car</title>
</head>

<body>
    <a href="../Home.php"><svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg></a>
    <h1 class="title">Add Car</h1>
    <form method="post" class="add car" enctype="multipart/form-data">
        <?php if (isset($message)) {
            echo "<h1 style='color:red'>" . $message . "</h1>";
        } else if (isset($db->message)) {
            echo "<h1 style='color:white'>" . $db->message . "</h1>";
        }
        ?>
        <div class="form-group">
            <label for="name">Brand</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control">
        </div>
        <div class="form-group">
            <label for="builyear">Build Year</label>
            <input type="date" name="builyear" id="builyear" class="form-control">
        </div>
        <div class="form-group license">
            <label for="licensePlate">LicensePlate</label>
            <input type="text" name="licensePlate" id="licensePlate" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type='file' name='file'>
        </div>
        <div class="choose">
            <div class="availability">
                <label for="availability">Availability</label>
                <input type="checkbox" name="availability" id="availability">
            </div>
            <div class="rent_buy">
                <select name="rent_buy" id="rent_buy">
                    <option value="rent">Rent</option>
                    <option value="buy">Buy</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="add" class="btn btn-primary">Add Car</button>
        </div>
    </form>
</body>

</html>