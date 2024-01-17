<?php

class Contact extends Database
{
    public $message;
    public function sendContact($user_id = null, $name, $email, $message)
    {
        $sql = "INSERT INTO contact (user_id, name, email, message, is_read, contactDate) VALUES (:user_id, :name, :email, :message, 'no', NOW())";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':message', $message);
        $query->execute();

        return $this->message = "Your message has been sent!";
    }

    public function getContact()
    {
        $qeury = $this->pdo->query("SELECT * FROM contact");
        return $qeury->fetchAll();
    }

    public function deleteContact($id)
    {
        $sql = "DELETE FROM contact WHERE contact_id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $this->message = "Contact has been deleted!";
    }

    public function readedContact($id)
    {
        $sql = "UPDATE contact SET is_read = 'yes' WHERE contact_id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $this->message = "Contact has been readed!";
        return $this->message;
    }
}
