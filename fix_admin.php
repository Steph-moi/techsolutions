<?php
require_once 'config/database.php';

// Nouveau mot de passe : admin123
$newPassword = password_hash('admin123', PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@techsolutions.com'");
    $stmt->execute([$newPassword]);
    
    echo "<h1>✅ Mot de passe admin corrigé !</h1>";
    echo "<p><strong>Identifiants :</strong></p>";
    echo "<ul>";
    echo "<li>Email : admin@techsolutions.com</li>";
    echo "<li>Mot de passe : admin123</li>";
    echo "</ul>";
    echo "<p><a href='api/login.php'>Se connecter</a></p>";
    
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>