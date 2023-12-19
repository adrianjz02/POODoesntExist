<?php
$serveur = "localhost";
$nomBdd = "POODoesntExist";
$utilisateur = "root";
$motDePasse = "";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBdd", $utilisateur, $motDePasse);
    // Configurer PDO pour qu'il lance des exceptions
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
}
catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
