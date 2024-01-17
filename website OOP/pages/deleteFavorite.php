<?php
session_start();
$id = $_GET['id'];
if (isset($id)) {
    require_once '../database class/Database.class.php';
    require_once '../database class/AddCar.class.php';

    $favorite = new AddCar();
    $favorite->deleteFavorite($id, $_SESSION['user_id']);
    header('Location: Vehicle.php');
} else {
    header('Location: Vehicle.php');
}
