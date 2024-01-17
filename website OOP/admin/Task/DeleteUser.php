<?php

require_once '../../database class/Database.class.php';
require_once '../../database class/GetUser.class.php';

$user = new Users();
$id = $_GET['userId'];

if ($id != null) {
    $user->deleteUser($id);
    header('Location: Custumer.php');
} else {
    header('Location: Custumer.php');
}
