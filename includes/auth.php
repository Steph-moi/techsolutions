<?php // Ouverture du tag PHP
require_once __DIR__ . '/../config/database.php'; // Inclusion du fichier de configuration de la base de données

function isLoggedIn() { // Fonction pour vérifier si l'utilisateur est connecté
    return isset($_SESSION['user_id']); // Retourne true si l'ID utilisateur existe en session
}

function isAdmin() { // Fonction pour vérifier si l'utilisateur est administrateur
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; // Vérifie si le rôle en session est 'admin'
}

function requireLogin() { // Fonction pour forcer la connexion
    if (!isLoggedIn()) { // Si l'utilisateur n'est pas connecté
        header('Location: /techsolutions/api/login.php'); // Redirection vers la page de connexion
        exit; // Arrêt de l'exécution du script
    }
}

function requireAdmin() { // Fonction pour forcer les droits administrateur
    requireLogin(); // Vérifie d'abord que l'utilisateur est connecté
    if (!isAdmin()) { // Si l'utilisateur n'est pas administrateur
        die('Accès refusé'); // Arrête le script avec un message d'erreur
    }
}
?>
