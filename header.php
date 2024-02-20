<?php
session_start();


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="styles/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logo-container">
            <a href="index.php">
                <img src="src/img/logo.png" alt="logo Garage VP">
            </a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php" class="nav-link">Accueil</a></li>
                <li><a href="#" class="nav-link">Horaires</a></li>
                <li><a href="#" class="nav-link">Services</a></li>
                <li><a href="#" class="nav-link">Voitures</a></li>
                <li><a href="#" class="nav-link">Contact</a></li>
            </ul>
        </nav>
        <div class="espace-pro">
            <?php if (isset($_SESSION['user_type'])): ?>
                <a href="?logout=true" class="btn-espace-pro">Déconnexion</a>
            <?php else: ?>
                <a href="login.php" class="btn-espace-pro">Espaces Professionnel</a>
            <?php endif; ?>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
