<?php
session_start();

if (isset($_POST["send"])) {
    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION["error"] = "All fields are required";
    } else {
        require_once("../database class/Database.class.php");
        require_once("../database class/Contact.class.php");

        $contact = new Contact();

        $contact->sendContact($user_id, $name, $email, $message);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/Contact.css">
    <title>Contact</title>
</head>

<body>
    <?php include('../include/Nav.php'); ?>
    <h1 class="title">CONTACT</h1>
    <div class="contact">
        <?php
        if (isset($_SESSION["error"]) || isset($contact->message)) {
            echo "<h1 class='message text-success'>" . (isset($_SESSION["error"]) ? $_SESSION["error"] : $contact->message) . "</h1>";
        }
        unset($_SESSION["error"]);
        ?>
        <div class="contact-info">
            <h1>Let's Chat</h1>
            <p>Do you have a question?</p>
            <p>Feel free to contact us.</p>
        </div>
        <div class="contact-form">
            <form method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" cols="30" rows="5" required></textarea>
                <button name="send">Send</button>
            </form>
        </div>
    </div>
    <?php include('../include/Footer.php'); ?>
</body>

</html>