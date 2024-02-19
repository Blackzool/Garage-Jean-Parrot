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
    
    $db->close();
    ?>
     
</head>
<body>

<!-- Contenu de la page -->
<section class="services">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="service">
          <img src="src\img\service_1.webp" alt="Service1" class="img-fluid">
          <h3>Entretien et vidange</h3>
          <p>Le service d'entretien + vidange comprend la vérification et la maintenance régulières des composants essentiels de votre véhicule, ainsi que le remplacement de l'huile moteur usée par de l'huile fraîche. Cela garantit le bon fonctionnement du moteur, prolonge sa durée de vie et maintient les performances optimales de votre voiture.</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="service">
          <img src="src\img\service_2.jpg" alt="Service2" class="img-fluid">
          <h3>Freinage-Disques et/ou plaquettes</h3>
          <p>Le service de freinage - remplacement des disques et/ou des plaquettes - implique l'inspection et le remplacement des composants de freinage usés ou endommagés, tels que les disques de frein et les plaquettes. Cela garantit un freinage efficace et sécurisé, améliorant ainsi la sécurité et les performances de votre véhicule.</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="service">
          <img src="src\img\service_3.jpg" alt="Service3" class="img-fluid">
          <h3>Changement de pneu</h3>
          <p>Le service de changement de pneu consiste à retirer les pneus usés de votre véhicule et à les remplacer par des pneus neufs ou adaptés aux conditions routières actuelles. Cela assure une adhérence optimale, une conduite sûre et une meilleure stabilité sur la route, contribuant ainsi à la sécurité et au confort de votre trajet.</p>
        </div>
      </div>
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


</body>
</html>
