<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
}
// check if the user is admin
require_once '../../database class/Database.class.php';
require_once '../../database class/Login.class.php';

$db = new Login();


try {
    if (isset($_POST["add"])) {

        $name = htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : null);
        $pass = htmlspecialchars(isset($_POST['password']) ? $_POST['password'] : null);
        $email = htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : null);
        $selectRol = htmlspecialchars(isset($_POST['role']) ? $_POST['role'] : null);

        if (!empty($name) && !empty($pass) && !empty($email) && !empty($selectRol)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
                $db->AddUser($name, $password, $email, $selectRol);
            } else {
                $message = "The email is not valid";
            }
        } else {
            $message = "All fields must be filled";
        }
    }
} catch (Exception $e) {
    $message = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Add User</title>
</head>

<body>

    <h1 class="title">Add User</h1>
    <form method="post" class="add">
        <a href="../Home.php"><svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
        <!-- Message -->
        <?php if (isset($message)) {
            echo "<h1 style='color:red'>" . $message . "</h1>";
        } else if (isset($db->registerMessage)) {
            echo "<h1 style='color:red'>" . $db->registerMessage . "</h1>";
        }
        ?>
        <!-- Message -->
        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" class="mb-4" fill="white" class="bi bi-person-fill-add" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4" />
        </svg>
        <label for="username">Username</label>
        <input class="input" type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input class="input" type="password" name="password" id="password" required>

        <label for="email">Email</label>
        <input class="input" type="email" name="email" id="email" required>
        <div class="select">
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <input type="submit" name="add" value="Add User">
        </div>
    </form>
    <script src="../assets/script.js"></script>
</body>

</html>