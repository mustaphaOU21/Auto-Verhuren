<?php
session_start();

$id = $_GET['id'];
$user = $_SESSION['user_id'];

if (isset($id)) {
    if (!isset($user)) {
        header('Location: ../pages/login.php');
    } else {
        require_once '../database class/Database.class.php';
        require_once '../database class/AddCar.class.php';

        $addCar = new AddCar();
        $addCar->favorite($id, $user);
        header('Location: Vehicle.php');
    }
} else {
    header('Location: Vehicle.php');
}
