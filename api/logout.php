<?php // Ouverture du tag PHP
session_start(); // Démarre ou reprend la session utilisateur
session_destroy(); // Détruit toutes les données de la session (déconnexion)
header('Location: /techsolutions/index.php'); // Redirection vers la page d'accueil
exit(); // Arrêt de l'exécution du script
?> <!-- Fermeture du tag PHP -->