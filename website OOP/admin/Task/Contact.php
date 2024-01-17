<?php
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header("location: ../../pages/Home.php");
    exit();
}

require_once '../../database class/Database.class.php';
require_once '../../database class/Contact.class.php';

$contacts = new Contact();

$contact = $contacts->getContact();

if (isset($_GET['delete_id'])) {
    $contacts->deleteContact($_GET['delete_id']);
    header("location: Contact.php");
} else if (isset($_GET['readed'])) {
    $contacts->readedContact($_GET['readed']);
    header("location: Contact.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Contact</title>
</head>

<body>
    <a href="javascript:history.back()">
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
    </a>
    <div class="container">
        <h1 class="title">Contact</h1>
        <?php
        if (isset($contacts->message)) {
            echo "<h2 class='message'>" . $contacts->message . "</h2>";
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Contact Date</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contact as $contact) { ?>
                    <tr>

                        <th scope="row"><?= $contact['contact_id'] ?></th>
                        <td><?= $contact['name'] ?></td>
                        <td><?= $contact['email'] ?></td>
                        <td><?= $contact['message'] ?></td>
                        <td><?= $contact['contactDate'] ?></td>
                        <?php if ($contact["is_read"] != "yes") { ?>
                            <td><a href="Contact.php?readed=<?= $contact['contact_id'] ?>" class="btn btn-primary">Readed</a></td>
                        <?php } else { ?>
                            <td class="bg-success text-light">Is Readed</td>
                        <?php } ?>
                        <td><a href="Contact.php?delete_id=<?= $contact['contact_id'] ?>" class="btn btn-danger">Delete</a></td>

                    </tr>
                <?php } ?>
            </tbody>

</body>

</html>