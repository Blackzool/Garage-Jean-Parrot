<?php
// Connexion bdd
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
            echo "Email ou mot de passe invalide";
        }
    } else {
        echo "Email ou mot de passe invalide";
    }
}

$db->close();
?>

<!-- Form de connexion-->
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
