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

    public function addConsultant($user_id, $specialization, $contact)
    {
        $stmt = $this->pdo->prepare("INSERT INTO consultants (user_id, specialization, contact) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $specialization, $contact]);
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

    public function updateConsultant($id, $user_id, $specialization, $contact)
    {
        $stmt = $this->pdo->prepare("UPDATE `consultants` SET `user_id` = ?, `contact` = ?, `specialization` = ? WHERE `consultants`.`id` = $id");
        return $stmt->execute([$user_id, $specialization, $contact]);
    }
    
}
