<?php
session_start();
// $user_id = $_SESSION['user_id'];
// require_once '../database class/Database.class.php';
// require_once '../database class/AddCar.class.php';
// $favorite = new AddCar();

// $favorites = $favorite->getFavorite($user_id);
// print_r($favorites);
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="file" name="file">
        <input type="submit" name="submit">
    </form>

</body>

</html>