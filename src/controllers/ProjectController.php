<?php
    
    require_once __DIR__ . '/../models/Project.php';
    require_once __DIR__ . '/../models/Client.php';

    class ProjectController
    {
        private $project;
        private $client;

        public function __construct($pdo)
        {
            $this->project = new Project($pdo);
            $this->client = new Client($pdo);
        }

        public function listProjects()
        {
            $projects = $this->project->getAllProjects();

            for ($i=0; $i < count($projects); $i++) { 
                $client =  $this->client->getClientById($projects[$i]['client_id']);
                $projects[$i]['client_name'] =  $client[0]['name'];
            }

            require __DIR__ . '/../views/projects/list.php';
        }


        public function createProject($title, $description, $client_id, $consultant_id, $start_date, $end_date)
        {
            if ($this->project->addProject($title, $description, $client_id, $consultant_id, $start_date, $end_date)) {
                header('Location: /cms_project/public/projects/');
                exit();
            } else {
                echo "Erreur lors de l'ajout du projet.";
            }
        }

        public function editProjectForm($id)
        {
            // echo "<pre>";
            //     print_r($project);
            // echo "</pre>";
            $project = $this->project->getProjectById($id);
            require __DIR__ . '/../views/projects/edit.php';
        }

        public function updateProject($id, $title, $description, $status, $start_date, $end_date)
        {
            if ($this->project->updateProject($id, $title, $description, $status, $start_date, $end_date)) {
                header('Location: /cms_project/public/projects/');
                exit();
            } else {
                echo "Erreur lors de la modification du projet.";
            }
        }

        public function deleteProject($id)
        {
            if ($this->project->deleteProjectById($id)) {
                header('Location: /cms_project/public/projects/');
                exit();
            } else {
                echo "Erreur lors de la suppression du projet.";
            }
        }


    }