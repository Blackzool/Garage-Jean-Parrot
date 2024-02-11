<header>
   <div>
    <h1>Garage Vincent Parrot</h1>
    <img src="" alt="logo Garage VP">
   </div> 
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            // Vérifier si l'utilisateur est connecté
            if ($utilisateurConnecte) {
                echo '<li><a href="profil.php">Profil</a></li>';
                echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
            } else {
                echo '<li><a href="connexion.php">Connexion</a></li>';
            }
            ?>
            <li><a href="voitures_occasion.php">Voitures d'occasion</a></li>
            <li><a href="services.php">Services</a></li>
        </ul>
    </nav>
</header>
