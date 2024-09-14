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

    // Méthode pour afficher le formulaire d'ajout de consultant
    public function showCreateForm()
    {
        require __DIR__ . '/../views/consultants/create.php';
    }

    // Méthode pour créer un nouveau consultant
    public function createConsultant($user_id, $specialization, $contact)
    {
        if (empty($user_id) || empty($specialization) || empty($contact)) {
            die('Tous les champs sont obligatoires.');
        }
        if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            die('Adresse e-mail invalide.');
        }

        $this->consultant->addConsultant($user_id, $specialization, $contact);
        header('Location: /cms_project/public/consultants/');
    }

    public function editConsultantForm($id)
    {
        $consultant = $this->consultant->getConsultantById($id);
        require __DIR__ . '/../views/consultants/edit.php';
    }

    public function updateConsultant($id, $user_id, $specialization, $contact)
    {
        if ($this->consultant->updateConsultant($id, $user_id, $specialization, $contact)) {
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
