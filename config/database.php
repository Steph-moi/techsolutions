<?php // Ouverture du tag PHP
// Configuration base de données - Commentaire expliquant le but du fichier
define('DB_HOST', 'localhost'); // Définit l'adresse du serveur de base de données (localhost = serveur local)
define('DB_NAME', 'techsolutions'); // Définit le nom de la base de données à utiliser
define('DB_USER', 'root'); // Définit le nom d'utilisateur pour se connecter à la BDD
define('DB_PASS', ''); // Définit le mot de passe (vide pour XAMPP par défaut)

try { // Début du bloc try pour gérer les erreurs de connexion
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS); // Création de l'objet PDO pour la connexion MySQL avec encodage UTF-8
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Configure le mode de récupération par défaut en tableau associatif
} catch(PDOException $e) { // Capture les exceptions PDO en cas d'erreur de connexion
    die("Erreur de connexion : " . $e->getMessage()); // Arrête le script et affiche le message d'erreur
}

session_start(); // Démarre ou reprend une session PHP pour gérer les données utilisateur
?> // Fermeture du tag PHP
