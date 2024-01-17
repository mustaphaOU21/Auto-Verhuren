<?php

class Cars extends Database
{

    public function getCars($id = null, $rent_buy = null)
    {
        // Get all cars
        $stmt = $this->pdo->query("SELECT * FROM Cars");
        $result = $stmt->fetchAll();

        if ($id != null) {
            // Get cars by id
            $stmt = $this->pdo->prepare("SELECT * FROM Cars WHERE car_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
        } else if ($id == null && $rent_buy != null) {
            // Get cars by rent_buy
            $stmt = $this->pdo->prepare("SELECT * FROM Cars WHERE rent_buy = :rent_buy");
            $stmt->bindParam(':rent_buy', $rent_buy);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }

        return $result;
    }

    public function search($input)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Cars WHERE Brand LIKE :input");
        $stmt->bindParam(':input', $input);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
