<!DOCTYPE html>
<html>
<head>
    <title>Données Volées - Exercice</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 5px; }
        .warning { background: #ff6b6b; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="warning">⚠️ EXERCICE PÉDAGOGIQUE - Données collectées par XSS</div>
    <h1>Données Volées</h1>
    
    <?php
    $logFile = 'stolen_data.txt';
    if (file_exists($logFile) && filesize($logFile) > 0) {
        echo '<pre>' . htmlspecialchars(file_get_contents($logFile)) . '</pre>';
    } else {
        echo '<p>Aucune donnée collectée.</p>';
    }
    ?>
    
    <form method="POST">
        <button type="submit" name="clear" style="background: red; color: white; padding: 10px; border: none; border-radius: 4px;">Effacer</button>
    </form>
    
    <?php
    if (isset($_POST['clear']) && file_exists($logFile)) {
        unlink($logFile);
        echo '<p style="color: green;">Logs effacés!</p>';
        echo '<script>setTimeout(() => location.reload(), 1000);</script>';
    }
    ?>
</body>
</html>