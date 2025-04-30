<?php
// Fichier: exemple6.5.php
// Description: Enregistrement des données avec affichage des dernières soumissions

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dernière Soumission</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>Inscription réussie</h1>
        <p>Merci pour votre soumission. Vos données ont été enregistrées avec succès.</p>
        <a href="expform2.html" class="btn">⬅ Retour au formulaire</a>
    </main>
</body>
</html>