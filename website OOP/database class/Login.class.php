<?php

class Login extends Database
{

    public $registerMessage;
    public $loginMessage;
    private $users = "users";

    // Register the user
    public function Register(string $name, string $password, string $email)
    {
        // Check if user already exists
        $user = $this->pdo->prepare("SELECT * FROM $this->users WHERE user_email = :user_email OR user_name = :user_name");
        $user->bindParam(':user_email', $email);
        $user->bindParam(':user_name', $name);
        $user->execute();
        // if the user already exists, return a message
        if ($user->rowCount() > 0) {
            $this->registerMessage = "Invalid email or password";
            return $this->registerMessage;
        }
        // if the user doesn't exist, insert the user
        else {
            $query = $this->pdo->prepare(
                "INSERT INTO $this->users (user_name, user_password, user_email, user_type)
            VALUES (:user_name, :user_password, :user_email, 'user')"
            );
            $query->bindParam(':user_name', $name);
            $query->bindParam(':user_password', $password);
            $query->bindParam(':user_email', $email);
            $query->execute();
            header("location: Login.php?registered=true");
        }
    }

    // Login the user
    public function Login($email, $password)
    {
        // Select password from database
        $query = $this->pdo->prepare("SELECT * FROM $this->users
                                      WHERE user_email = :user_email");

        $query->bindParam(':user_email', $email);
        $query->execute();

        if ($query->rowCount() > 0) {
            $row = $query->fetch();
            // Check if password is correct
            $hashedPassword = $row['user_password'];
            if (password_verify($password, $hashedPassword)) {
                // Set session variables
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_type'] = $row['user_type'];
                if ($row['user_type'] == "admin") {
                    header("location: ../admin/Home.php");
                } else {
                    header("location: Home.php");
                }
            } else {
                $this->loginMessage = "Invalid email or password";
                return $this->loginMessage;
            }
        } else {
            $this->loginMessage = "Invalid email or password";
            return $this->loginMessage;
        }
    }

    // Add user by admin

    public function AddUser($name, $password, $email, $role)
    {
        // Check if user already exists
        $user = $this->pdo->prepare("SELECT * FROM $this->users WHERE user_email = :user_email OR user_name = :user_name");
        $user->bindParam(':user_email', $email);
        $user->bindParam(':user_name', $name);
        $user->execute();
        // if the user already exists, return a message
        if ($user->rowCount() > 0) {
            $this->registerMessage = "Invalid email or password";
            return $this->registerMessage;
        }
        // if the user doesn't exist, insert the user
        else {
            $query = $this->pdo->prepare(
                "INSERT INTO $this->users (user_name, user_password, user_email, user_type)
                    VALUES (:user_name, :user_password, :user_email, :user_type)"
            );
            $query->bindParam(':user_name', $name);
            $query->bindParam(':user_password', $password);
            $query->bindParam(':user_email', $email);
            $query->bindParam(':user_type', $role);
            $query->execute();
            header("Location: AddUser.php?added=true");
        }
    }
}
