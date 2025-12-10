<?php // Ouverture du tag PHP
/*
 * SCRIPT DE RÉINITIALISATION DU MOT DE PASSE ADMINISTRATEUR
 * 
 * Ce fichier sert à réinitialiser le mot de passe de l'administrateur en cas d'oubli.
 * ATTENTION : Ce fichier doit être supprimé après utilisation pour des raisons de sécurité.
 * 
 * Utilisation :
 * - Accéder à ce fichier via le navigateur (ex: localhost/techsolutions/fix_admin.php)
 * - Le mot de passe admin sera automatiquement changé en "admin123"
 * - Se connecter avec les nouveaux identifiants
 * - SUPPRIMER ce fichier immédiatement après usage
 */

require_once 'config/database.php'; // Inclusion du fichier de configuration de la base de données

// Nouveau mot de passe : admin123 - Commentaire indiquant le nouveau mot de passe
$newPassword = password_hash('admin123', PASSWORD_DEFAULT); // Hachage sécurisé du nouveau mot de passe avec l'algorithme par défaut

try { // Début du bloc try pour gérer les erreurs de base de données
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@techsolutions.com'"); // Préparation de la requête de mise à jour du mot de passe pour l'admin
    $stmt->execute([$newPassword]); // Exécution de la requête avec le nouveau mot de passe haché
    
    echo "<h1>✅ Mot de passe admin corrigé !</h1>"; // Affichage du message de succès
    echo "<p><strong>Identifiants :</strong></p>"; // Affichage du titre des identifiants
    echo "<ul>"; // Début de la liste des identifiants
    echo "<li>Email : admin@techsolutions.com</li>"; // Affichage de l'email administrateur
    echo "<li>Mot de passe : admin123</li>"; // Affichage du nouveau mot de passe
    echo "</ul>"; // Fin de la liste
    echo "<p><a href='api/login.php'>Se connecter</a></p>"; // Lien vers la page de connexion
    
} catch(PDOException $e) { // Capture des exceptions PDO en cas d'erreur
    echo "Erreur : " . $e->getMessage(); // Affichage du message d'erreur
}
?>