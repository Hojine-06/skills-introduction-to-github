<?php
// Fichier: affiche.php
// Description: Enregistrement et affichage des données du formulaire dans la base de données

// Connexion à la base de données
$host = 'localhost';
$dbname = 'club_echecs';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . htmlspecialchars($e->getMessage()));
}

// Validation et récupération des données du formulaire
$nom = htmlspecialchars($_POST['ident'][0] ?? '');
$prenom = htmlspecialchars($_POST['ident'][1] ?? '');
$age = filter_var($_POST['ident'][2] ?? '', FILTER_VALIDATE_INT);

// Langues sélectionnées
$langues = isset($_POST['lang']) ? implode(", ", array_map('htmlspecialchars', $_POST['lang'])) : '';

// Compétences sélectionnées
$competences = isset($_POST['competent']) ? implode(", ", array_map('htmlspecialchars', $_POST['competent'])) : '';

if (!$nom || !$prenom || !$age) {
    die("Erreur : Tous les champs obligatoires doivent être remplis.");
}

// Insertion des données dans la base
try {
    $query = "INSERT INTO utilisateurs (nom, prenom, age, langues, competences) 
              VALUES (:nom, :prenom, :age, :langues, :competences)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':langues', $langues);
    $stmt->bindParam(':competences', $competences);

    $stmt->execute();

    echo "Inscription réussie !";
} catch (PDOException $e) {
    die("Erreur lors de l'insertion des données : " . htmlspecialchars($e->getMessage()));
}
?>