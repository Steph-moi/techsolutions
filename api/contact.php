<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $sujet = trim($_POST['sujet']);
    $message = trim($_POST['message']);
    $consent = isset($_POST['consent_rgpd']);
    
    if (!$consent) {
        die('Vous devez accepter la politique de confidentialité');
    }
    
    $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message, consent_rgpd) 
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $sujet, $message, $consent]);
    
    $_SESSION['contact_success'] = true;
    header('Location: /techsolutions/contact.php');
    exit;
}
?>
