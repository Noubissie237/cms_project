<?php

require_once __DIR__ . '/../models/Client.php';

class ClientController
{
    private $client;

    public function __construct($pdo)
    {
        $this->client = new Client($pdo);
    }

    public function listClients()
    {
        $clients = $this->client->getAllClients();
        require __DIR__ . '/../views/clients/list.php';
    }

    // Méthode pour afficher le formulaire d'ajout de client
    public function showCreateForm()
    {
        require __DIR__ . '/../views/clients/create.php';
    }

    // Méthode pour créer un nouveau client
    public function createClient($name, $contact, $email)
    {
        if (empty($name) || empty($contact) || empty($email)) {
            die('Tous les champs sont obligatoires.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Adresse e-mail invalide.');
        }

        $this->client->addClient($name, $contact, $email);
        header('Location: /cms_project/public/clients/');
    }

    public function editClientForm($id)
    {
        $client = $this->client->getClientById($id);
        require __DIR__ . '/../views/clients/edit.php';
    }

    public function updateClient($id, $name, $contact, $email)
    {
        if ($this->client->updateClient($id, $name, $contact, $email)) {
            header('Location: /cms_project/public/clients/');
            exit();
        } else {
            echo "Erreur lors de la modification du client.";
        }
    }

    public function deleteClient($id)
    {
        if ($this->client->deleteClientById($id)) {
            header('Location: /cms_project/public/clients/');
            exit();
        } else {
            echo "Erreur lors de la suppression du client.";
        }
    }
}
