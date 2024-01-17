<?php

require_once '../../database class/Database.class.php';
require_once '../../database class/GetOrders.class.php';

$orders = new Orders();
$id = $_GET['id'];
$user_id = $_GET['user_id'];

if ($id != null) {
    $orders->deleteOrder($id, $user_id);
    header('Location: Orders.php');
} else {
    header('Location: Orders.php');
}
