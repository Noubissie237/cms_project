<?php

require_once __DIR__ . '/../../config/database.php';

class Project
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProjects()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM projects");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addProject($title, $description, $client_id, $consultant_id, $start_date, $end_date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO projects (title, description, client_id, consultant_id, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $client_id, $consultant_id, $start_date, $end_date]);
    }

    public function getProjectById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteProjectById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM projects WHERE `projects`.`id` = $id");
        return $stmt->execute();
    }

    public function updateProject($id, $title, $description, $status, $start_date, $end_date)
    {
        $stmt = $this->pdo->prepare("UPDATE `projects` SET `title` = ?, `description` = ?, `status` = ?, `start_date` = ?, `end_date` = ?  WHERE `projects`.`id` = $id");
        return $stmt->execute([$title, $description, $status, $start_date, $end_date]);
    }

}
