<?php

require_once("../database class/Database.class.php");
require_once("../database class/Login.class.php");

try {
    $db = new Database();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$login = new Login();

// Register the user
if (isset($_POST['register'])) {
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    // Hash the password
    $password = isset($_POST['pswd']) ? htmlspecialchars($_POST['pswd']) : '';
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Check if all fields are filled
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['pswd'])) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $registerMessage = "Invalid email format";
        } else {
            $login->Register($name, $password, $email);
        }
    } else {
        $registerMessage = "All fields are required";
    }
}

// Login the user
if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['pswd']);

    // Check if all fields are filled
    if (!empty($_POST['email']) && !empty($_POST['pswd'])) {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loginMessage = "Invalid email format";
        } else {
            $login->Login($email, $password);
        }
    } else {
        $loginMessage = "All fields are required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <a href="Home.php">
        <svg class="leave" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
    </a>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

            <form method="post">
                <label for="chk" aria-hidden="true">Sign up</label>
                <?php
                // Display the register message
                if (isset($registerMessage)) {
                    echo "<h4 class='rgmessage'>" . $registerMessage . "</h4>";
                }
                if (isset($login->registerMessage)) {
                    echo "<h4 class='rgmessage'>" . $login->registerMessage . "</h4>";
                }
                ?>
                <input type="text" name="name" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button name="register">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <?php
                // Display the login message
                if (isset($loginMessage)) {
                    echo "<h4 class='lgmessage'>" . $loginMessage . "</h4>";
                }
                if (isset($login->loginMessage)) {
                    echo "<h4 class='lgmessage'>" . $login->loginMessage . "</h4>";
                }
                ?>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button name="login">Login</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/script.js"></script>
</body>

</html>