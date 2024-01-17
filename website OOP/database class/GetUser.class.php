<?php

class Users extends Database
{

    public function getUser(int $id = null, string $userType = null)
    {
        $query = "SELECT * FROM users";
        $userData = [];

        if ($id !== null) {
            $stmt = "SELECT * FROM users WHERE user_id = :id";
            $query = $this->pdo->prepare($stmt);
            $query->bindParam(":id", $id);
            $query->execute();
            $userData = $query->fetch();
        } elseif ($userType !== null) {
            $stmt = "SELECT * FROM users WHERE user_type != :user_type";
            $query = $this->pdo->prepare($stmt);
            $query->bindParam(":user_type", $userType);
            $query->execute();
            $userData = $query->fetchAll();
        } else {
            $query = $this->pdo->query($query);
            $userData = $query->fetchAll();
        }

        return $userData;
    }


    public function getUserInfo(int $id = null)
    {
        $stmt = "SELECT * FROM users_info";
        $info = $this->pdo->query($stmt);
        $user = $info->fetchAll();

        if ($id !== null) {
            $stmt = "SELECT ui.*, u.verify, u.booked
            FROM users_info ui
            JOIN users u ON ui.user_id = u.user_id
            WHERE ui.user_id = :id";
            $info = $this->pdo->prepare($stmt);
            $info->bindParam(":id", $id);
            $info->execute();
            $user = $info->fetch();
        }

        return $user;
    }

    public function updateUser(int $id, string $verify, string $comment = null)
    {
        $stmt = "UPDATE users SET verify = :verify, Comment = :comment WHERE user_id = :id";
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(":verify", $verify);
        $query->bindParam(":comment", $comment);
        $query->bindParam(":id", $id);
        $query->execute();
    }

    public function deleteUser(int $id)
    {
        $stmt = "DELETE FROM users_info WHERE user_id = :id";
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(":id", $id);
        $query->execute();

        $stmt = "DELETE FROM users WHERE user_id = :id";
        $query = $this->pdo->prepare($stmt);
        $query->bindParam(":id", $id);
        $query->execute();
    }
}
