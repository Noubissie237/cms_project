<?php

require_once __DIR__ . '/../../config/database.php';

class Report
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllReports()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reports");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addReport($project_id, $description, $date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO reports (project_id, description, date) VALUES (?, ?, ?)");
        return $stmt->execute([$project_id, $description, $date]);
    }

    public function deleteReportById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM reports WHERE `reports`.`id` = $id");
        return $stmt->execute();
    }

    public function getReportById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reports WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateReport($id, $project_id, $description, $date)
    {
        $stmt = $this->pdo->prepare("UPDATE `reports` SET `project_id` = ?, `description` = ?, `date` = ? WHERE `reports`.`id` = $id");
        return $stmt->execute([$project_id, $description, $date]);
    }
}
