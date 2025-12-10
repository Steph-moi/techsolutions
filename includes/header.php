<?php if (session_status() == PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechSolutions - Solutions Technologiques Innovantes</title>
    <link rel="stylesheet" href="/techsolutions/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="/techsolutions/assets/images/techsolution.png" alt="TechSolutions" class="logo-img">
                <span>TechSolutions</span>
            </div>
            <ul>
                <li><a href="/techsolutions/index.php">Accueil</a></li>
                <li><a href="/techsolutions/services.php">Services</a></li>
                <li><a href="/techsolutions/actualites.php">Actualités</a></li>
                <li><a href="/techsolutions/contact.php">Contact</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="/techsolutions/admin/index.php" style="background: #e74c3c; padding: 0.5rem 1rem; border-radius: 4px;">🔧 Admin</a></li>
                    <?php endif; ?>
                    <li><a href="/techsolutions/api/logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/techsolutions/api/login.php">Connexion</a></li>
                    <li><a href="/techsolutions/register.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>