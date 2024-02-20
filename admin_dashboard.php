<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="styles\style.css" rel="stylesheet">
</head>
<body>
    <section>
        <h1>Bienvenue M.PARROT</h1>
        <p>Voici votre panneau de configuration ici vous pouvez ajoutez ou modifiez vos différents services etc...</p>
        <a href="index.php" class="button">Retour à l'accueil</a>
    </section>
    <?php
    // Connexion bdd
    $db = new SQLite3('db.sqlite');

    // Traitement du formulaire d'ajout employé
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
        $name = SQLite3::escapeString(trim($_POST['name']));
        $email = SQLite3::escapeString(trim($_POST['email']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role_id = 2; 
        $insert_query = "INSERT INTO utilisateurs (Nom_Utilisateur, Email, Mot_de_passe, ID_Role) VALUES ('$name', '$email', '$password', $role_id)";
        if($db->exec($insert_query)) {
            echo "Employé ajouté avec succès";
        } else {
            echo "Erreur ajout employé";
        }
    }

    // Traitement de l'ajout d'un nouveau service
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_service'])) {
        $nom = SQLite3::escapeString($_POST['nom']);
        $description = SQLite3::escapeString($_POST['description']);
        $image = SQLite3::escapeString($_POST['image']);

        $insert_query = "INSERT INTO services (nom, description, image) VALUES ('$nom', '$description', '$image')";

        if($db->exec($insert_query)) {
            echo "Service ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du service.";
        }
    }
     // Vérifier s'il s'agit d'une mise à jour de service
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_service'])) {
        $id = SQLite3::escapeString($_POST['service_id']);
        $nom = SQLite3::escapeString($_POST['nom']);
        $description = SQLite3::escapeString($_POST['description']);
        $image = SQLite3::escapeString($_POST['image']);
        $update_query = "UPDATE services SET nom = '$nom', description = '$description', image = '$image' WHERE id = $id";
        if($db->exec($update_query)) {
            echo "Le service a été mis à jour.";
        } else {
            echo "Erreur lors de la mise à jour du service.";
        }
    }
    // Formulaire de mise à jour des services
    if (isset($_GET['edit_service_id'])) {
        $edit_service_id = SQLite3::escapeString($_GET['edit_service_id']);
        $service_query = "SELECT * FROM services WHERE id = '$edit_service_id'";
        $service_result = $db->querySingle($service_query, true);
        if ($service_result) {
            echo "<section>
            <h2>Éditer le Service</h2>
            <form method='post' action=''>
                <input type='hidden' name='service_id' value='{$edit_service_id}'>
                <label for='nom'>Nom:</label>
                <input type='text' id='nom' name='nom' value=\"{$service_result['nom']}\" required><br><br>
                <label for='description'>Description:</label>
                <textarea id='description' name='description' required>{$service_result['description']}</textarea><br><br>
                <label for='image'>Image URL:</label>
                <input type='text' id='image' name='image' value=\"{$service_result['image']}\" required><br><br>
                <input type='submit' name='update_service' value='Mettre à jour le service'>
            </form>
            </section>";
        }
    }

    // Afficher les services avec éditer/supprimer des options
    $results = $db->query("SELECT id, nom FROM services");
    while ($row = $results->fetchArray()) {
        echo "
        <section>
        <div>
            <span>{$row['nom']}</span>
            <a href='?edit_service_id={$row['id']}'>Éditer</a>
            <a href='?delete_service_id={$row['id']}'>Supprimer</a>
        </div>
        </section>";
    }
    // Traitement de la suppression d'un service
    if (isset($_GET['delete_service_id'])) {
        $delete_service_id = SQLite3::escapeString($_GET['delete_service_id']);
        $delete_query = "DELETE FROM services WHERE id = '$delete_service_id'";
        if($db->exec($delete_query)) {
            echo "Le service a été supprimé.";
            header("Location: admin_dashboard.php"); // Pour actualiser et nettoyer l'URL
        } else {
            echo "Erreur lors de la suppression du service.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hours'])) {
        // Préparez la requête de mise à jour
        $query = "UPDATE Heures_ouverture SET 
                  heures_ouverture_matin = :heures_ouverture_matin, 
                  heures_fermeture_matin = :heures_fermeture_matin, 
                  heures_ouverture_apresmidi = :heures_ouverture_apresmidi, 
                  heures_fermeture_apresmidi = :heures_fermeture_apresmidi 
                  WHERE jour_id = :jour_id";
        foreach ($_POST['day'] as $day_id => $times) {
            $stmt = $db->prepare($query);
            foreach ($times as $key => $time) {
                if ($time === '00:00') {
                    $times[$key] = 'fermé';
                }
            }
            $stmt->bindValue(':jour_id', $day_id, SQLITE3_INTEGER);
            $stmt->bindValue(':heures_ouverture_matin', $times['heures_ouverture_matin'], SQLITE3_TEXT);
            $stmt->bindValue(':heures_fermeture_matin', $times['heures_fermeture_matin'], SQLITE3_TEXT);
            $stmt->bindValue(':heures_ouverture_apresmidi', $times['heures_ouverture_apresmidi'], SQLITE3_TEXT);
            $stmt->bindValue(':heures_fermeture_apresmidi', $times['heures_fermeture_apresmidi'], SQLITE3_TEXT);
            $result = $stmt->execute();
            if (!$result) {
                
                echo "Erreur lors de la mise à jour des horaires pour le jour $day_id.";
            }
        }
    }
    

    ?>

    <!--Formulaire d'ajout de service -->
    <section>
    <h3>Ajout d'un service</h3>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <label for="nom">Nom du service:</label>
        <input type="text" name="nom" placeholder=" Service" id="nom" required><br><br>
        <label for="description">Description:</label>
        <textarea name="description" placeholder="Description" id="description" required></textarea><br><br>
        <label for="image">Image (URL):</label>
        <input type="text" name="image" placeholder="Beausite.png" id="image" required><br><br>
        <input type="submit" name="add_service" value="Ajouter le Service">
    </form>
    </section>

    <!--Formulaire d'ajout d'employés -->
    <section class="employes">
     <h3>Ajout d'un employé</h3>
     <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <label for="name">Nom:</label>
        <input type="text" name="name" placeholder=" Jean Kevin" id="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder=" JeanKevin@mail.fr" id="email" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" placeholder="Jk13000" id="password" required><br><br>
        <input type="submit" name="add_employee"  value="Ajoutez l'employé">
     </form>
    </section>

    <section>
        <h3>Changez les horaires de votre garage </h3>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <?php
    if ($db) {
        $dayResults = $db->query("SELECT * FROM JourSemaine LEFT JOIN Heures_ouverture ON JourSemaine.id = Heures_ouverture.jour_id ORDER BY JourSemaine.id ASC");
        while ($day = $dayResults->fetchArray(SQLITE3_ASSOC)) {
            // Use a loop to generate input fields for each day
            echo "<div>";
            echo "<strong>" . htmlspecialchars($day['name']) . ":</strong><br>";
            // Morning opening time
            echo "Ouverture matin: <input type='time' name='day[{$day['id']}][heures_ouverture_matin]' value='" . htmlspecialchars($day['heures_ouverture_matin']) . "'><br>";
            // Morning closing time
            echo "Fermeture matin: <input type='time' name='day[{$day['id']}][heures_fermeture_matin]' value='" . htmlspecialchars($day['heures_fermeture_matin']) . "'><br>";
            // Afternoon opening time
            echo "Ouverture après-midi: <input type='time' name='day[{$day['id']}][heures_ouverture_apresmidi]' value='" . htmlspecialchars($day['heures_ouverture_apresmidi']) . "'><br>";
            // Afternoon closing time
            echo "Fermeture après-midi: <input type='time' name='day[{$day['id']}][heures_fermeture_apresmidi]' value='" . htmlspecialchars($day['heures_fermeture_apresmidi']) . "'><br>";
            echo "</div>";
        }
    }
    ?>
    <input type="submit" name="update_hours" value="Mettre à jour les horaires">
</form>
    </section>

<?php include('footer.php');?>
<?php $db->close();?>
</body>
</html>
