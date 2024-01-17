<?php
session_start();
if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}
require_once '../../database class/Database.class.php';
require_once '../../database class/GetCars.class.php';
require_once '../../database class/Edit.class.php';

$getCars = new Cars();
$cars = $getCars->getCars();
$edit = new Edit();
$editMessage = $edit->message;

$id = isset($_GET['id']) ? $_GET['id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Edit Car</title>
</head>

<body>
    <a href="../Home.php"><svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg></a>
    <h1 class="title">Edit Car</h1>
    <form method="post">
        <?php if (isset($message)) {
            echo "<h1 style='color:red'>" . $message . "</h1>";
        } else if (isset($db->message)) {
            echo "<h1 style='color:white'>" . $db->message . "</h1>";
        } else if (isset($editMessage)) {
            echo "<h1 style='color:green'>" . $editMessage . "</h1>";
            var_dump($edit->message);
        }
        ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Model</th>
                    <th scope="col">Build Year</th>
                    <th scope="col">License Plate</th>
                    <th scope="col">Price</th>
                    <th scope="col">Availability</th>
                    <th scope="col">Rent/Buy</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car) {  ?>
                    <tr>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["car_id"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["Brand"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["Model"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["Year"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["LicensePlate"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo "€" . $car["Price"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["Availability"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>"><?php echo $car["rent_buy"] ?></td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>">
                            <a href=" Edit.php?car_id=<?php echo $car["car_id"] ?>"><button type="button" name="edit" class="btn btn-primary btn-sm">Edit</button></a>
                        </td>
                        <td class="<?php if ($car["car_id"] == $id) echo "bg-primary-subtle" ?>">
                            <a href="Delete.php?car_id=<?php echo $car["car_id"] ?>"><button type="button" name="delete" class="btn btn-danger btn-sm">Delete</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </form>
</body>

</html>