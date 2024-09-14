<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/ClientController.php';
require_once __DIR__ . '/../src/controllers/ProjectController.php';
require_once __DIR__ . '/../src/controllers/ConsultantController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/cms_project/public/clients/') {
    $controller = new ClientController($pdo);
    $controller->listClients();
} elseif ($uri === '/cms_project/public/clients/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/clients/create.php'; 
} elseif ($uri === '/cms_project/public/clients/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->createClient($_POST['name'], $_POST['contact'], $_POST['email']);
} elseif ($uri === '/cms_project/public/projects/') {
    $controller = new ProjectController($pdo);
    $controller->listProjects();
} elseif ($uri === '/cms_project/public/projects/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupère les clients et consultants pour les options du formulaire
    $controller = new ProjectController($pdo);
    $clients = (new Client($pdo))->getAllClients();
    $consultants = (new Consultant($pdo))->getAllConsultants();
    require __DIR__ . '/../src/views/projects/create.php';
} elseif ($uri === '/cms_project/public/projects/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->createProject($_POST['title'], $_POST['description'], $_POST['client_id'], $_POST['consultant_id'], $_POST['start_date'], $_POST['end_date']);
}

// Afficher le formulaire de modification
if (preg_match('/\/clients\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ClientController($pdo);
    $controller->editClientForm($matches[1]);
}

// Traiter la modification
if (preg_match('/\/clients\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->updateClient($matches[1], $_POST['name'], $_POST['contact'], $_POST['email']);
}

if (preg_match('/\/clients\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->deleteClient($matches[1]);
}

// Modifier un projet
if (preg_match('/\/projects\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ProjectController($pdo);
    $controller->editProjectForm($matches[1]);
} elseif (preg_match('/\/projects\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->updateProject($matches[1], $_POST['title'], $_POST['description'], $_POST['status'], $_POST['start_date'], $_POST['end_date']);
}

// Supprimer un projet
if (preg_match('/\/projects\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->deleteProject($matches[1]);
}
