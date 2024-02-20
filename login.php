<?php
session_start();

// Connexion BDD
$db = new SQLite3('db.sqlite');

// Vérifie les informations de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = SQLite3::escapeString($_POST['email']);
    $password = $_POST['password'];

    // Créez une requête préparée pour vous protéger contre les injections SQL
    $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE Email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($row = $result->fetchArray()) {
        // Vérifiez le mot de passe haché
        if (password_verify($password, $row['Mot_de_passe'])) {
            // Définir les variables de session
            $_SESSION['user_id'] = $row['ID_Utilisateur'];
            $_SESSION['user_type'] = $row['ID_Role']; // Assumer '1' pour admin, sinon employé

            // Authentification réussie
            if ($row['ID_Role'] == 1) {
                // Redirection vers le tableau de bord administrateur
                header("Location: admin_dashboard.php");
                exit(); // Arrête l'exécution du script après la redirection
            } else {
                // Redirection vers le tableau de bord employé
                header("Location: employee_dashboard.php");
                exit();
            }
        } else {
            // Authentification échouée
            $error_message = "Email ou mot de passe invalide";
        }
    } else {
        $error_message = "Email ou mot de passe invalide";
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <?php if(!empty($error_message)): ?>
    <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <section>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="adresse@mail.com" id="email" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" placeholder="jesuislemdp" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    </section>
    
</body>
</html>
