<?php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function listUsers()
    {
        $users = $this->user->getAllUsers();
        require __DIR__ . '/../views/users/list.php';
    }

    // Méthode pour afficher le formulaire d'ajout d'utilisateur
    public function showCreateForm()
    {
        require __DIR__ . '/../views/users/create.php';
    }

    // Méthode pour créer un nouvel utilisateur
    public function createUser($name, $email, $password, $role)
    {
        if (empty($name) || empty($email) || empty($password)) {
            die('Tous les champs sont obligatoires.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Adresse e-mail invalide.');
        }

        $this->user->addUser($name, $email, $password, $role);
        header('Location: /cms_project/public/users/');
    }

    public function editUserForm($id)
    {
        $user = $this->user->getUserById($id);
        require __DIR__ . '/../views/users/edit.php';
    }

    public function updateUser($id, $name, $email, $role)
    {
        if ($this->user->updateUser($id, $name, $email, $role)) {
            header('Location: /cms_project/public/users/');
            exit();
        } else {
            echo "Erreur lors de la modification de l'utilisateur.";
        }
    }

    public function deleteUser($id)
    {
        if ($this->user->deleteUserById($id)) {
            header('Location: /cms_project/public/users/');
            exit();
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }
}
