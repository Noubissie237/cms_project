<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/ClientController.php';
require_once __DIR__ . '/../src/controllers/ProjectController.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../src/controllers/ConsultantController.php';
require_once __DIR__ . '/../src/controllers/InvoiceController.php';
require_once __DIR__ . '/../src/controllers/ReportController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/* ----------- CLIENT -----------*/

if ($uri === '/cms_project/public/clients/') {
    $controller = new ClientController($pdo);
    $controller->listClients();
} elseif ($uri === '/cms_project/public/clients/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/clients/create.php'; 
} elseif ($uri === '/cms_project/public/clients/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->createClient($_POST['name'], $_POST['contact'], $_POST['email']);
} 

if (preg_match('/\/clients\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ClientController($pdo);
    $controller->editClientForm($matches[1]);
}

if (preg_match('/\/clients\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->updateClient($matches[1], $_POST['name'], $_POST['contact'], $_POST['email']);
}

if (preg_match('/\/clients\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClientController($pdo);
    $controller->deleteClient($matches[1]);
}


/* ----------- PROJECT -----------*/

if ($uri === '/cms_project/public/projects/') {
    $controller = new ProjectController($pdo);
    $controller->listProjects();
} elseif ($uri === '/cms_project/public/projects/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ProjectController($pdo);
    $clients = (new Client($pdo))->getAllClients();
    $consultants = (new Consultant($pdo))->getAllConsultants();
    require __DIR__ . '/../src/views/projects/create.php';
} elseif ($uri === '/cms_project/public/projects/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->createProject($_POST['title'], $_POST['description'], $_POST['client_id'], $_POST['consultant_id'], $_POST['start_date'], $_POST['end_date']);
}

if (preg_match('/\/projects\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ProjectController($pdo);
    $controller->editProjectForm($matches[1]);
} elseif (preg_match('/\/projects\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->updateProject($matches[1], $_POST['title'], $_POST['description'], $_POST['status'], $_POST['start_date'], $_POST['end_date']);
}
if (preg_match('/\/projects\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProjectController($pdo);
    $controller->deleteProject($matches[1]);
}


/* ----------- USERS -----------*/

if ($uri === '/cms_project/public/users/') {
    $controller = new UserController($pdo);
    $controller->listUsers();
} elseif ($uri === '/cms_project/public/users/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/users/create.php'; 
} elseif ($uri === '/cms_project/public/users/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController($pdo);
    $controller->createUser($_POST['name'], $_POST['password'], $_POST['email'], $_POST['role']);
}

if (preg_match('/\/users\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new UserController($pdo);
    $controller->editUserForm($matches[1]);
}

if (preg_match('/\/users\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController($pdo);
    $controller->updateUser($matches[1], $_POST['name'], $_POST['password'], $_POST['email']);
}

if (preg_match('/\/users\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController($pdo);
    $controller->deleteUser($matches[1]);
}

/* ----------- CONSULTANTS -----------*/

if ($uri === '/cms_project/public/consultants/') {
    $controller = new ConsultantController($pdo);
    $controller->listConsultants();
} elseif ($uri === '/cms_project/public/consultants/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/consultants/create.php'; 
} elseif ($uri === '/cms_project/public/consultants/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ConsultantController($pdo);
    $controller->createConsultant($_POST['name'], $_POST['expertise'], $_POST['email']);
}

if (preg_match('/\/consultants\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ConsultantController($pdo);
    $controller->editConsultantForm($matches[1]);
}

if (preg_match('/\/consultants\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ConsultantController($pdo);
    $controller->updateConsultant($matches[1], $_POST['name'], $_POST['expertise'], $_POST['email']);
}

if (preg_match('/\/consultants\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ConsultantController($pdo);
    $controller->deleteConsultant($matches[1]);
}

/* ----------- INVOICES -----------*/

if ($uri === '/cms_project/public/invoices/') {
    $controller = new InvoiceController($pdo);
    $controller->listInvoices();
} elseif ($uri === '/cms_project/public/invoices/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/invoices/create.php'; 
} elseif ($uri === '/cms_project/public/invoices/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new InvoiceController($pdo);
    $controller->createInvoice($_POST['client_id'], $_POST['amount'], $_POST['status']);
}

if (preg_match('/\/invoices\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new InvoiceController($pdo);
    $controller->editInvoiceForm($matches[1]);
}

if (preg_match('/\/invoices\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new InvoiceController($pdo);
    $controller->updateInvoice($matches[1], $_POST['client_id'], $_POST['amount'], $_POST['status']);
}

if (preg_match('/\/invoices\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new InvoiceController($pdo);
    $controller->deleteInvoice($matches[1]);
}

/* ----------- REPORTS -----------*/

if ($uri === '/cms_project/public/reports/') {
    $controller = new ReportController($pdo);
    $controller->listReports();
} elseif ($uri === '/cms_project/public/reports/create/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require __DIR__ . '/../src/views/reports/create.php'; 
} elseif ($uri === '/cms_project/public/reports/create/' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ReportController($pdo);
    $controller->createReport($_POST['project_id'], $_POST['description'], $_POST['date']);
}

if (preg_match('/\/reports\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new ReportController($pdo);
    $controller->editReportForm($matches[1]);
}

if (preg_match('/\/reports\/edit\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ReportController($pdo);
    $controller->updateReport($matches[1], $_POST['project_id'], $_POST['description'], $_POST['date']);
}

if (preg_match('/\/reports\/delete\/(\d+)/', $uri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ReportController($pdo);
    $controller->deleteReport($matches[1]);
}