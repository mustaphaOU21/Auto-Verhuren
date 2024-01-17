<?php

class Orders extends Database
{

    public function getOrders($id = null)
    {

        $stmt = $this->pdo->query("SELECT * FROM Orders");
        $result = $stmt->fetchAll();

        if ($id != null) {
            $stmt = $this->pdo->prepare("SELECT * FROM Orders WHERE user_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
        }

        return $result;
    }

    public function deleteOrder($id, $user_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Orders WHERE order_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt = $this->pdo->prepare("Update users SET booked = 'no' WHERE user_id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
    }
}
