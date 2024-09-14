<?php

require_once __DIR__ . '/../../config/database.php';

class Client
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllClients()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addClient($name, $contact, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (name, contact, email) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $contact, $email]);
    }

    public function deleteClientById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM clients WHERE `clients`.`id` = $id");
        return $stmt->execute();
    }

    public function getClientById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateClient($id, $name, $contact, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE `clients` SET `name` = ?, `contact` = ?, `email` = ? WHERE `clients`.`id` = $id");
        return $stmt->execute([$name, $contact, $email]);
    }
    
}
