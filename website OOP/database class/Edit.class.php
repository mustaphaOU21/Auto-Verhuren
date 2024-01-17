<?php

class Edit extends Database
{
    public $message;

    public function editCar($id, $brand, $model, $year, $licenseplate, $price, $availability, $rent_buy)
    {
        $stmt = $this->pdo->prepare('UPDATE cars SET Brand = :brand, Model = :model, Year = :year, LicensePlate = :licenseplate, Price = :price, Availability = :availability, rent_buy = :rent_buy WHERE car_id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':licenseplate', $licenseplate);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':rent_buy', $rent_buy);
        $stmt->execute();

        $this->message = 'Car edited successfully';
        header('Location: EditCar.php');
        return $this->message;
    }
}
