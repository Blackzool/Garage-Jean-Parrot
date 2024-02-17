<?php
$host = 'localhost';
$port = '5432';
$dbname = 'GarageVParrot';
$user = 'VincentParrot';
$password = 'Voiture15Parrot';

try {
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>
