<?php

require_once __DIR__ . '/../models/Report.php';

class ReportController
{
    private $report;

    public function __construct($pdo)
    {
        $this->report = new Report($pdo);
    }

    public function listReports()
    {
        $reports = $this->report->getAllReports();
        require __DIR__ . '/../views/reports/list.php';
    }

    public function showCreateForm()
    {
        require __DIR__ . '/../views/reports/create.php';
    }

    public function createReport($project_id, $description, $date)
    {
        if (empty($project_id) || empty($description) || empty($date)) {
            die('Tous les champs sont obligatoires.');
        }

        $this->report->addReport($project_id, $description, $date);
        header('Location: /cms_project/public/reports/');
    }

    public function editReportForm($id)
    {
        $report = $this->report->getReportById($id);
        require __DIR__ . '/../views/reports/edit.php';
    }

    public function updateReport($id, $project_id, $description, $date)
    {
        if ($this->report->updateReport($id, $project_id, $description, $date)) {
            header('Location: /cms_project/public/reports/');
            exit();
        } else {
            echo "Erreur lors de la modification du rapport.";
        }
    }

    public function deleteReport($id)
    {
        if ($this->report->deleteReportById($id)) {
            header('Location: /cms_project/public/reports/');
            exit();
        } else {
            echo "Erreur lors de la suppression du rapport.";
        }
    }
}
