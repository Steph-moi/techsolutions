<?php // Ouverture du tag PHP
require_once '../config/database.php'; // Inclusion du fichier de configuration de la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si le formulaire a été soumis en méthode POST
    $nom = trim($_POST['nom']); // Récupère et nettoie le nom saisi
    $email = trim($_POST['email']); // Récupère et nettoie l'email saisi
    $sujet = trim($_POST['sujet']); // Récupère et nettoie le sujet saisi
    $message = trim($_POST['message']); // Récupère et nettoie le message saisi
    $consent = isset($_POST['consent_rgpd']); // Vérifie si la case de consentement RGPD est cochée
    
    if (!$consent) { // Si le consentement n'est pas donné
        die('Vous devez accepter la politique de confidentialité'); // Arrête le script avec un message d'erreur
    }
    
    $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message, consent_rgpd) 
                           VALUES (?, ?, ?, ?, ?)"); // Prépare la requête d'insertion du message de contact
    $stmt->execute([$nom, $email, $sujet, $message, $consent]); // Exécute l'insertion avec les données du formulaire
    
    $_SESSION['contact_success'] = true; // Définit un indicateur de succès en session
    header('Location: /techsolutions/contact.php'); // Redirection vers la page de contact
    exit; // Arrêt de l'exécution du script
}
?> <!-- Fermeture du tag PHP -->
