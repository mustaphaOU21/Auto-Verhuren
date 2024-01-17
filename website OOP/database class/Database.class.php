<?php

class Database
{
    protected $pdo;

    public function __construct(
        string $servername = "localhost",
        string $db = "CAR",
        string $username = "root",
        string $password = "QweMus?!123!"
    ) {
        $this->pdo = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
