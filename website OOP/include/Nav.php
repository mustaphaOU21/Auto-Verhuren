<?php


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($user_id != null) {
    require_once '../database class/Database.class.php';
    require_once '../database class/AddCar.class.php';
    require_once '../database class/GetUser.class.php';
    $favorite = new AddCar();
    $users = new Users();

    $favorites = $favorite->getFavorite($user_id);
    $user = $users->getUser($user_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/include.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="Home.php"><img src="../assets/img/Logo.png"></a></li>
        </ul>
        <ul class="links">
            <li><a class="link" href="../pages/Vehicle.php">VEHICLE</a></li>
            <li><a class="link" href="../pages/Contact.php">CONTACT</a></li>
            <li><a class="link" href="../pages/About.php">ABOUT US</a></li>
        </ul>
        <div class="hamburegremenu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul>
            <?php
            // If user is not login
            if (!isset($_SESSION['user_id'])) {
            ?>

                <li class="login">
                    <a class="login" href="../pages/Login.php">LOGIN</a>
                </li>
                <?php
                ?>

            <?php
                // If user is login
            } else {
            ?>
                <!-- validation -->
                <?php if ($user["verify"] != null) { ?>
                    <a href="../pages/validation.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-car-front" viewBox="0 0 16 16">
                            <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276" />
                            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z" />
                        </svg>
                    </a>
                <?php } ?>
                <!-- Favorite -->
                <div class="favorite">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>

                    <ul class="favoritelist">
                        <h2>Favorite</h2>
                        <?php foreach ($favorites as $favorite) { ?>
                            <ul>
                                <li>
                                    <a href="../pages/VehicleDetail.php"><img src="../assets/img/<?= $favorite['car_image'] ?>"></a>
                                </li>
                                <li><?= $favorite['Brand'] ?> <?= $favorite['Model'] ?></li><br>
                                <li>
                                    <a href="../pages/VehicleDetail.php?id=<?= $favorite['car_id'] ?>">
                                        <?php if ($favorite["rent_buy"] == "rent") {
                                            echo "Rent";
                                        } else {
                                            echo "Buy";
                                        } ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="../pages/deleteFavorite.php?id=<?= $favorite['car_id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">

                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        <?php } ?>
                    </ul>
                </div>

                <!-- User -->
                <div class="user">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z" />
                    </svg>

                    <ul class="user-menu">
                        <li><a href="Profile.php">PROFILE</a></li>
                        <li><a href="Logout.php">LOGOUT</a></li>
                        <?php if ($_SESSION["user_type"] == "admin") { ?>
                            <li><a href="../admin/Home.php">ADMIN PANEL</a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php
            }
            ?>
        </ul>
    </nav>
    <script src="../assets/js/script.js"></script>
</body>

</html>