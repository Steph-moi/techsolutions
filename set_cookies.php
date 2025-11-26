<?php
// Création de cookies de test pour l'exercice XSS
setcookie('user_session', 'abc123def456', time() + 3600, '/');
setcookie('user_id', '12345', time() + 3600, '/');
setcookie('auth_token', 'token_secret_123', time() + 3600, '/');
setcookie('preferences', 'theme=dark;lang=fr', time() + 3600, '/');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cookies créés</title>
</head>
<body>
    <h1>Cookies de test créés</h1>
    <p>Les cookies suivants ont été créés :</p>
    <ul>
        <li>user_session = abc123def456</li>
        <li>user_id = 12345</li>
        <li>auth_token = token_secret_123</li>
        <li>preferences = theme=dark;lang=fr</li>
    </ul>
    <p><a href="../Documents/Cours Balmisse/phishing controlée/facturephishing.html">Ouvrir la facture de phishing</a></p>
</body>
</html>