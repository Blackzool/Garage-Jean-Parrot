<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>T'es BEAU</h1>
    <?php
// Connexion bdd
$db = new SQLite3('db.sqlite');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    
    $name = SQLite3::escapeString(trim($_POST['name']));
    $email = SQLite3::escapeString(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash mdp
    $role_id = 2; // Role ID Employes
    $insert_query = "INSERT INTO utilisateurs (Nom_Utilisateur, Email, Mot_de_passe, ID_Role) VALUES ('$name', '$email', '$password', $role_id)";
    if($db->exec($insert_query)) {
        echo "Employee added successfully";
    } else {
        echo "Error adding employee";
    }
}
$db->close();
?>

<!--Formulaire ajout employés -->
<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" name="add_employee" value="Add Employee">
</form>

</body>
</html>