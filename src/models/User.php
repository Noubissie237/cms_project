<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addUser($name, $email, $password, $role)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword, $role]);
    }

    public function deleteUserById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE `users`.`id` = $id");
        return $stmt->execute();
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateUser($id, $name, $email, $role)
    {
        $stmt = $this->pdo->prepare("UPDATE `users` SET `name` = ?, `email` = ?, `role` = ? WHERE `users`.`id` = $id");
        return $stmt->execute([$name, $email, $role]);
    }
}
