<?php

require_once __DIR__ . '/../models/Consultant.php';

class ConsultantController
{
    private $consultant;

    public function __construct($pdo)
    {
        $this->consultant = new Consultant($pdo);
    }

    public function listConsultants()
    {
        $consultants = $this->consultant->getAllConsultants();
        require __DIR__ . '/../views/consultants/list.php';
    }

    public function showCreateForm()
    {
        require __DIR__ . '/../views/consultants/create.php';
    }

    public function createConsultant($name, $specialization, $email)
    {
        if (empty($name) || empty($specialization) || empty($email)) {
            die('Tous les champs sont obligatoires.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Adresse e-mail invalide.');
        }

        $this->consultant->addConsultant($name, $specialization, $email);
        header('Location: /cms_project/public/consultants/');
    }

    public function editConsultantForm($id)
    {
        $consultant = $this->consultant->getConsultantById($id);
        require __DIR__ . '/../views/consultants/edit.php';
    }

    public function updateConsultant($id, $name, $specialization, $email)
    {
        if ($this->consultant->updateConsultant($id, $name, $specialization, $email)) {
            header('Location: /cms_project/public/consultants/');
            exit();
        } else {
            echo "Erreur lors de la modification du consultant.";
        }
    }

    public function deleteConsultant($id)
    {
        if ($this->consultant->deleteConsultantById($id)) {
            header('Location: /cms_project/public/consultants/');
            exit();
        } else {
            echo "Erreur lors de la suppression du consultant.";
        }
    }
}
