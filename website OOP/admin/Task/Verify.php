<?php

session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}

require_once '../../database class/Database.class.php';
require_once '../../database class/GetUser.class.php';

$userId = $_GET['userId'];
$verify = $_GET['verify'];

if (isset($verify) && isset($userId)) {
    if ($verify == 'invalid') {
        if (isset($_POST['verify'])) {
            $comment = $_POST['comment'];
            $user = new Users();
            $user->updateUser($userId, $verify, $comment);
            header("location: Custumer.php");
        }
?>
        <form method="post">
            <input type="text" name="comment" placeholder="Comment Why">
            <button class="btn btn-primary" name="verify" type="submit">Verify</button>
        </form>
<?php
    } else {
        $user = new Users();
        $user->updateUser($userId, $verify);
        header("location: Custumer.php");
    }
} else {
    header("Location: ../Home.php");
}
