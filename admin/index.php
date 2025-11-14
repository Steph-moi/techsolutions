<?php
require_once '../includes/auth.php';
requireAdmin();
?>
<?php include '../includes/header.php'; ?>

<section class="admin-dashboard">
    <h1>Tableau de bord Administrateur</h1>
    
    <div class="admin-menu">
        <a href="articles.php" class="admin-card">
            <h3>Gestion des Actualités</h3>
            <p>Créer, modifier et supprimer des articles</p>
        </a>
        
        <a href="ordinateurs.php" class="admin-card">
            <h3>Gestion des Ordinateurs</h3>
            <p>Gérer le catalogue de vente d'ordinateurs</p>
        </a>
        
        <a href="users.php" class="admin-card">
            <h3>Gestion des Utilisateurs</h3>
            <p>Gérer les comptes clients</p>
        </a>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
