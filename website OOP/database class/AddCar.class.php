<?php

class AddCar extends Database
{
    public $message;
    public function addCar($brand, $model, $year, $license, $price, $image, $availability, $rent_buy, $image_tmp)
    {
        $sql = "SELECT * FROM Cars WHERE LicensePlate = :license";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':license', $license);
        $query->execute();
        if ($query->rowCount() > 0) {
            $this->message = "Car already exists";
        } else {
            // move uploaded file to upload folder
            $imageDestination = "../../assets/img/" . $image;
            move_uploaded_file($image_tmp, $imageDestination);
            $sql = "INSERT INTO Cars (Brand, Model, Price, Year, car_image, LicensePlate, Availability, rent_buy) VALUES (:brand, :model, :price, :year, :image, :license, :availability, :rent_buy)";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':brand', $brand);
            $query->bindParam(':model', $model);
            $query->bindParam(':price', $price);
            $query->bindParam(':year', $year);
            $query->bindParam(':image', $image);
            $query->bindParam(':license', $license);
            $query->bindParam(':availability', $availability);
            $query->bindParam(':rent_buy', $rent_buy);
            $query->execute();

            $this->message = "Car added successfully";
        }
    }

    public function favorite($id, $user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM favorite WHERE user_id = :user AND car_id = :id");
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $favorite = $stmt->fetchAll();
        if (count($favorite) > 0) {
            $this->message = "Car already in favorites";
        } else {
            $sql = "INSERT INTO Favorite (user_id, car_id) VALUES (:user, :id)";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':user', $user);
            $query->bindParam(':id', $id);
            $query->execute();
            $this->message = "Car added to favorites";
        }
    }

    public function getFavorite($user)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM favorite 
            INNER JOIN Cars ON favorite.car_id = Cars.car_id 
            WHERE user_id = :user");
        $stmt->bindValue(':user', $user);
        $stmt->execute();
        $favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $favorite;
    }

    public function deleteFavorite($id, $user)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Favorite WHERE user_id = :user AND car_id = :id");
        $stmt->bindValue(':user', $user);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function booking($user_id, $car, $name, $phone, $birth_date, $address, $zipCode, $image, $image_tmp)
    {
        // Check if the car is available.
        $stmt = "SELECT Availability FROM Cars WHERE car_id = :car";
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(':car', $car);
        $query->execute();
        $availability = $query->fetch(PDO::FETCH_ASSOC);

        if ($availability["Availability"] == "yes") {
            // Insert the user information into the users_info table.
            $stmt = "INSERT INTO users_info (user_id, name, phone_number, birth_date, address, zip_code, driverLicense) 
                            VALUES 
                            (:user_id, :name, :phone, :birth_date, :address, :zipCode, :driverLicense)";

            $query = $this->pdo->prepare($stmt);

            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':name', $name);
            $query->bindParam(':phone', $phone);
            $query->bindParam(':birth_date', $birth_date);
            $query->bindParam(':address', $address);
            $query->bindParam(':zipCode', $zipCode);
            $query->bindParam(':driverLicense', $image);
            $query->execute();

            // Check if the user information was inserted successfully.
            if ($query->rowCount() > 0) {
                // update user validation
                $stmt = "UPDATE Users SET verify = 'waiting' WHERE user_id = :user_id";

                $query = $this->pdo->prepare($stmt);
                $query->bindParam(':user_id', $user_id);
                $query->execute();

                // move uploaded file to upload folder
                $imageDestination = "../admin/assets/image/" . $image;
                move_uploaded_file($image_tmp, $imageDestination);

                session_start();
                $_SESSION["booking"] = "waiting";

                header("Location: Checkout.php");
            } else {
                header("Location: ../pages/Vehicle.php?error=failed");
            }
        } else {
            header("Location: ../pages/Vehicle.php");
        }
    }

    public function Order(string $user, int $car, string $rent_buy, string $startDate = null, string $endDate = null, string $comment = null, string $orderDate = null, string $paid)
    {
        $stmt = "INSERT INTO Orders (user_id, car_id, rent_buy, startDate, endDate, comment, orderDate, paid) 
        VALUES (:user_id, :car_id, :rent_buy, :startDate, :endDate, :comment, :orderDate, :paid)";

        $query = $this->pdo->prepare($stmt);

        $query->bindParam(':user_id', $user);
        $query->bindParam(':car_id', $car);
        $query->bindParam(':rent_buy', $rent_buy);
        $query->bindParam(':startDate', $startDate);
        $query->bindParam(':endDate', $endDate);
        $query->bindParam(':comment', $comment);
        $query->bindParam(':orderDate', $orderDate);
        $query->bindParam(':paid', $paid);

        $query->execute();
        session_start();
        $_SESSION["order_id"] = $this->pdo->lastInsertId();

        // Update the availability of the car to no.
        $stmt = "UPDATE Cars SET Availability = 'no' WHERE car_id = :car";
        $update = $this->pdo->prepare($stmt);
        $update->bindParam(':car', $car);
        $update->execute();

        $stmt = "UPDATE Users SET booked = 'yes' WHERE user_id = :user";
        $update = $this->pdo->prepare($stmt);
        $update->bindParam(':user', $user);
        $update->execute();

        $_SESSION["invoice"] = "yes";

        header("Location: ../pages/invoice.php?car=" . $car);
    }
}
