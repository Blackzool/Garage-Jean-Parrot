<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <footer>
    <section>
    <h3>Horaires d'ouverture:</h3>
    <ul>
    <?php 
    $hoursResults = $db->query("SELECT * FROM Heures_ouverture ho JOIN JourSemaine js ON ho.jour_id = js.id ORDER BY ho.jour_id ASC");
    if ($hoursResults) {
        while ($row = $hoursResults->fetchArray(SQLITE3_ASSOC)) {
            echo '<li>' . htmlspecialchars($row['name']) . ': ' . 
                htmlspecialchars($row['heures_ouverture_matin']) . ' - ' . 
                htmlspecialchars($row['heures_fermeture_matin']) . ', ' . 
                htmlspecialchars($row['heures_ouverture_apresmidi']) . ' - ' . 
                htmlspecialchars($row['heures_fermeture_apresmidi']) . '</li>';
        }
    } else {
        echo '<li>Les horaires d\'ouverture ne sont pas disponibles pour le moment.</li>';
    }
    ?>
    </ul>
    </section>
    
 </footer>

</body>
</html>
