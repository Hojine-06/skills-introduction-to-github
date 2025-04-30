<?php
// Connexion à la base de données
$servername = "localhost";  // Si tu utilises localhost, sinon indique l'adresse de ton serveur
$username = "root";         // Utilisateur de la base de données
$password = "";             // Mot de passe (si nécessaire)
$dbname = "club_echecs"; // Nom de la base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prénom = $_POST['prénom'];
$date_naissance = $_POST['date'];
$activité = $_POST['Activité'];
$choix = implode(', ', array_filter([$_POST['choix1'], $_POST['choix2'], $_POST['choix3']])); // Concaténer les choix
$semaine = $_POST['semaine'];
$motivations = $_POST['motivations'];

// Préparer et exécuter la requête d'insertion
$sql = "INSERT INTO stage (nom, prénom, date_naissance, activité, choix, semaine, motivations) 
        VALUES ('$nom', '$prénom', '$date_naissance', '$activité', '$choix', $semaine, '$motivations')";

if ($conn->query($sql) === TRUE) {
    echo "Données enregistrées avec succès.";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dernière Soumission</title>
    <style>
        body {
            background: url('http://localhost/formulaire/pictures/matricee.gif') no-repeat center center fixed;
    background-size: cover;
            color: #00FF00; /* Texte vert fluo */
            font-family: "Courier New", monospace;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 2px solid #00FF00;
        }
        th, td {
            border: 1px solid #00FF00;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #003300;
        }
        td {
            background-color: #001A00;
        }
        a {
            color: #00FF00;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<a href="expform1.html">⬅ Retour au formulaire</a>

</body>
</html>