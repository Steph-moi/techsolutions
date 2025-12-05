<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireAdmin(); // Vérification des droits administrateur (fonction qui redirige si pas admin)
?> <!-- Fermeture du tag PHP -->
<?php include '../includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="admin-dashboard"> <!-- Section du tableau de bord admin avec classe CSS -->
    <h1>Tableau de bord Administrateur</h1> <!-- Titre principal du tableau de bord -->
    
    <div class="admin-menu"> <!-- Conteneur du menu d'administration -->
        <a href="articles.php" class="admin-card"> <!-- Lien vers la gestion des articles -->
            <h3>Gestion des Actualités</h3> <!-- Titre de la carte -->
            <p>Créer, modifier et supprimer des articles</p> <!-- Description de la fonctionnalité -->
        </a> <!-- Fin du lien articles -->
        
        <a href="ordinateurs.php" class="admin-card"> <!-- Lien vers la gestion des ordinateurs -->
            <h3>Gestion des Ordinateurs</h3> <!-- Titre de la carte -->
            <p>Gérer le catalogue de vente d'ordinateurs</p> <!-- Description de la fonctionnalité -->
        </a> <!-- Fin du lien ordinateurs -->
        
        <a href="users.php" class="admin-card"> <!-- Lien vers la gestion des utilisateurs -->
            <h3>Gestion des Utilisateurs</h3> <!-- Titre de la carte -->
            <p>Gérer les comptes clients</p> <!-- Description de la fonctionnalité -->
        </a> <!-- Fin du lien utilisateurs -->
    </div> <!-- Fin du conteneur menu -->
</section> <!-- Fin de la section tableau de bord -->

<?php include '../includes/footer.php'; ?>
