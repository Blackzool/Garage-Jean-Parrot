<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Site Web - Accueil</title>
    <link href="front\styles\style.css" rel="stylesheet">
    <!-- Inclure le header -->
    <?php include("header.php");

    $db = new SQLite3('db.sqlite');
    
    // Récupérer les services de la base de données
    $results = $db->query("SELECT * FROM services");
    $services = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        array_push($services, $row);
    }
    
    
    ?>
     
</head>
<body>

<!-- Contenu de la page -->
<section class="services">
  <div class="container-fluid">
    <div class="row">
      <?php foreach ($services as $service): ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="service">
            <img src="<?php echo htmlspecialchars($service['image']); ?>" alt="Service" class="img-fluid">
            <h3><?php echo htmlspecialchars($service['nom']); ?></h3>
            <p><?php echo htmlspecialchars($service['description']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  </section>


<section class="occasions">
 <div class="car-list row">
  <a href="#" class="car-button col-md-4">
    <img src="src\img\voitures\n1\voiture_1_2.jpg" alt="Voiture à vendre" class="img-fluid">
    <h3>Audi A1</h3>
    <p>Prix : 10000 €</p>
    <p>Année : 2022</p>
    <p>Kilométrage : 20000 km</p>
  </a>

  <a href="#" class="car-button col-md-4">
    <img src="src\img\voitures\n2\voiture_2_4.jpg" alt="Voiture à vendre" class="img-fluid">
    <h3>Renault Captur</h3>
    <p>Prix : 12000 €</p>
    <p>Année : 2020</p>
    <p>Kilométrage : 25000 km</p>
  </a>

  <a href="#" class="car-button col-md-4">
    <img src="src\img\voitures\n3\voiture_3_2.jpg" alt="Voiture à vendre" class="img-fluid">
    <h3>Honda CR-V</h3>
    <p>Prix : 15000 €</p>
    <p>Année : 2019</p>
    <p>Kilométrage : 18000 km</p>
  </a>

  <a href="occasions.php" class="view-all-button">Voir tous les véhicules</a>
 </div>
</section>

<?php include('footer.php');
$db->close(); ?>
</body>

</html>
