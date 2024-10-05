<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultancy Management System</title>
    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Couleur de fond claire */
        body {
            background: url('images/home.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Centrage du contenu de la page */
        .centerPage {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: moveUpDown 3s ease-in-out infinite;
        }

        /* Animation pour le mouvement */
        @keyframes moveUpDown {
            0%, 100% {
                transform: translate(-50%, -50%);
            }
            50% {
                transform: translate(-50%, -47%);
            }
        }

        /* Style pour le titre */
        h1 {
            font-size: 48px;
            color: #2980b9;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Style pour le texte de bienvenue */
        p {
            font-size: 20px;
            color: #fff;
        }

        /* Style de la navbar */
        .navbar-dark {
            background-color: #2980b9;
        }

        /* Liens de la navbar */
        .nav-link {
            font-size: 18px;
            color: #ecf0f1 !important;
            transition: color 0.3s ease;
        }

        /* Hover sur les liens de la navbar */
        .nav-link:hover {
            color: #1abc9c !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Consultancy System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./clients/list_clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./projets/list_projets.php">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./consultants/list_consultants.php">Consultants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./factures/list_factures.php">Factures</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-5 centerPage text-center">
        <h1>Bienvenue dans le système de gestion de conseil</h1>
        <p>Utilisez le menu pour naviguer dans les différentes sections.</p>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
