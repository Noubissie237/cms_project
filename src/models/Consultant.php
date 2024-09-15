<?php

require_once __DIR__ . '/../../config/database.php';

class Consultant
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllConsultants()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM consultants");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addConsultant($name, $specialization, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO consultants (name, specialization, email) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $specialization, $email]);
    }

    public function deleteConsultantById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM consultants WHERE `consultants`.`id` = $id");
        return $stmt->execute();
    }

    public function getConsultantById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM consultants WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateConsultant($id, $name, $specialization, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE `consultants` SET `name` = ?, `specialization` = ?, `email` = ? WHERE `consultants`.`id` = $id");
        return $stmt->execute([$name, $specialization, $email]);
    }
}
