<?php
// Configuration de la connexion à la base de données
$host = 'localhost';
$dbname = 'club_echecs';
$username = 'root';
$password = '';

try {
    // Création d'une connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Gestion des erreurs
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>