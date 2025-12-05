<?php if (session_status() == PHP_SESSION_NONE) { session_start(); } ?> <!-- Vérifie si une session n'est pas déjà démarrée et la démarre si nécessaire -->
<!DOCTYPE html> <!-- Déclaration du type de document HTML5 -->
<html lang="fr"> <!-- Balise HTML principale avec langue française -->
<head> <!-- Début de l'en-tête du document -->
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure l'affichage responsive pour mobiles -->
    <title>TechSolutions - Solutions Technologiques Innovantes</title> <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <link rel="stylesheet" href="/techsolutions/assets/css/style.css"> <!-- Lien vers la feuille de style CSS -->
</head> <!-- Fin de l'en-tête -->
<body> <!-- Début du corps de la page -->
    <header> <!-- Début de l'en-tête de la page -->
        <nav> <!-- Balise de navigation -->
            <div class="logo"> <!-- Conteneur pour le logo -->
                <img src="/techsolutions/assets/images/techsolution.png" alt="TechSolutions" class="logo-img"> <!-- Image du logo avec texte alternatif -->
                <span>TechSolutions</span> <!-- Texte du nom de l'entreprise -->
            </div> <!-- Fin du conteneur logo -->
            <ul> <!-- Liste non ordonnée pour le menu de navigation -->
                <li><a href="/techsolutions/index.php">Accueil</a></li> <!-- Lien vers la page d'accueil -->
                <li><a href="/techsolutions/actualites.php">Actualités</a></li> <!-- Lien vers la page des actualités -->
                <li><a href="/techsolutions/contact.php">Contact</a></li> <!-- Lien vers la page de contact -->
                <?php if(isset($_SESSION['user_id'])): ?> <!-- Vérifie si l'utilisateur est connecté -->
                    <li><a href="/techsolutions/api/logout.php">Déconnexion</a></li> <!-- Affiche le lien de déconnexion si connecté -->
                <?php else: ?> <!-- Sinon (utilisateur non connecté) -->
                    <li><a href="/techsolutions/api/login.php">Connexion</a></li> <!-- Affiche le lien de connexion -->
                    <li><a href="/techsolutions/register.php">Inscription</a></li> <!-- Affiche le lien d'inscription -->
                <?php endif; ?> <!-- Fin de la condition -->
            </ul> <!-- Fin de la liste de navigation -->
        </nav> <!-- Fin de la navigation -->
    </header> <!-- Fin de l'en-tête -->
    <main> <!-- Début du contenu principal de la page -->
