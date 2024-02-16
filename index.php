<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Site Web - Accueil</title>
    <!-- Inclure le header -->
    <?php include("header.php"); ?>
</head>
<body>

<!-- Contenu de la page -->
<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="service border p-3">
          <img src="src\img\entretien_auto_revision_vidange.jpg" alt="Vidange+Entretien" class="img-fluid">
          <h3>Entretien et vidange</h3>
          <p>Le service d'entretien + vidange comprend la vérification et la maintenance régulières des composants essentiels de votre véhicule, ainsi que le remplacement de l'huile moteur usée par de l'huile fraîche. Cela garantit le bon fonctionnement du moteur, prolonge sa durée de vie et maintient les performances optimales de votre voiture.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service border p-3">
          <img src="src\img\freinage_disques_plaquettes_auto.jpg" alt="Freinage-Disques/plaquettes" class="img-fluid">
          <h3>Freinage-Disques et/ou plaquettes</h3>
          <p>Le service de freinage - remplacement des disques et/ou des plaquettes - implique l'inspection et le remplacement des composants de freinage usés ou endommagés, tels que les disques de frein et les plaquettes. Cela garantit un freinage efficace et sécurisé, améliorant ainsi la sécurité et les performances de votre véhicule.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service border p-3">
          <img src="src\img\pneumatiques_auto.jpg" alt="changementpneu" class="img-fluid">
          <h3>Changement de pneu</h3>
          <p>Le service de changement de pneu consiste à retirer les pneus usés de votre véhicule et à les remplacer par des pneus neufs ou adaptés aux conditions routières actuelles. Cela assure une adhérence optimale, une conduite sûre et une meilleure stabilité sur la route, contribuant ainsi à la sécurité et au confort de votre trajet.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="occasions">
 <div class="car-list">
  <a href="#" class="car-button">
    <img src="src\img\voitures\n1\1116x744-ea9df90ae46648da985b51e45063d483.jpg" alt="Voiture à vendre">
    <h3>Nom du modèle de la voiture 1</h3>
    <p>Prix : 10000 €</p>
    <p>Année : 2022</p>
    <p>Kilométrage : 20000 km</p>
  </a>

  <a href="#" class="car-button">
    <img src="src\img\voitures\n2\1116x744-b355157a4d7844fc81811519524b196f.jpg" alt="Voiture à vendre">
    <h3>Nom du modèle de la voiture 2</h3>
    <p>Prix : 12000 €</p>
    <p>Année : 2020</p>
    <p>Kilométrage : 25000 km</p>
  </a>

  <a href="#" class="car-button">
    <img src="src\img\voitures\n3\1116x744-2ac6f1b5d0004939b7321948d64cd68a.jpg" alt="Voiture à vendre">
    <h3>Nom du modèle de la voiture 3</h3>
    <p>Prix : 15000 €</p>
    <p>Année : 2019</p>
    <p>Kilométrage : 18000 km</p>
  </a>
 </div>
</section>

</body>
</html>
