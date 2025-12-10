<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireAdmin(); // Vérification des droits administrateur

// Suppression (avec logs RGPD) - Commentaire expliquant la suppression avec traçabilité
if (isset($_GET['delete'])) { // Vérifie si un ID d'utilisateur à supprimer est passé en paramètre
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'delete', 'Suppression par admin')"); // Prépare l'insertion d'un log RGPD
    $stmt->execute([$_GET['delete']]); // Exécute l'insertion du log pour traçabilité
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'"); // Prépare la suppression (empêche la suppression d'admins)
    $stmt->execute([$_GET['delete']]); // Exécute la suppression de l'utilisateur
    header('Location: users.php'); // Redirection vers la page de gestion des utilisateurs
    exit; // Arrêt de l'exécution du script
}

$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll(); // Récupération de tous les utilisateurs triés par date d'inscription décroissante
?>
<?php include '../includes/header.php'; ?> <!-- Inclusion de l'en-tête de la page -->

<section class="admin-users"> <!-- Section de gestion des utilisateurs avec classe CSS -->
    <div class="admin-header"> <!-- En-tête de la section admin -->
        <h1>Gestion des Utilisateurs</h1> <!-- Titre principal de la page -->
        <a href="index.php" class="btn-back">← Retour au tableau de bord</a> <!-- Lien de retour vers le tableau de bord -->
    </div> <!-- Fin de l'en-tête -->
    
    <table> <!-- Tableau des utilisateurs -->
        <thead> <!-- En-tête du tableau -->
            <tr> <!-- Ligne d'en-tête -->
                <th>Email</th> <!-- Colonne email -->
                <th>Nom</th> <!-- Colonne nom -->
                <th>Prénom</th> <!-- Colonne prénom -->
                <th>Téléphone</th> <!-- Colonne téléphone -->
                <th>Rôle</th> <!-- Colonne rôle -->
                <th>Inscription</th> <!-- Colonne date d'inscription -->
                <th>Actions</th> <!-- Colonne actions -->
            </tr> <!-- Fin de la ligne d'en-tête -->
        </thead> <!-- Fin de l'en-tête -->
        <tbody> <!-- Corps du tableau -->
            <?php foreach($users as $user): ?> <!-- Boucle pour parcourir chaque utilisateur -->
            <tr> <!-- Ligne de données utilisateur -->
                <td><?= htmlspecialchars($user['email']) ?></td> <!-- Cellule email sécurisée -->
                <td><?= htmlspecialchars($user['nom']) ?></td> <!-- Cellule nom sécurisée -->
                <td><?= htmlspecialchars($user['prenom']) ?></td> <!-- Cellule prénom sécurisée -->
                <td><?= htmlspecialchars($user['telephone'] ?? '-') ?></td> <!-- Cellule téléphone avec valeur par défaut si null -->
                <td><span style="color: <?= $user['role'] === 'admin' ? '#e74c3c' : '#27ae60' ?>"><?= ucfirst($user['role']) ?></span></td> <!-- Cellule rôle avec couleur conditionnelle (rouge pour admin, vert pour user) -->
                <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td> <!-- Cellule date d'inscription formatée -->
                <td> <!-- Cellule actions -->
                    <?php if($user['role'] !== 'admin'): ?> <!-- Vérifie si l'utilisateur n'est pas administrateur -->
                        <a href="?delete=<?= $user['id'] ?>" 
                           onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a> <!-- Lien de suppression avec confirmation pour les utilisateurs normaux -->
                    <?php else: ?> <!-- Sinon (utilisateur administrateur) -->
                        <span style="color: #95a5a6;">Protégé</span> <!-- Texte indiquant que l'admin est protégé -->
                    <?php endif; ?> <!-- Fin de la condition -->
                </td> <!-- Fin de la cellule actions -->
            </tr> <!-- Fin de la ligne utilisateur -->
            <?php endforeach; ?> <!-- Fin de la boucle -->
        </tbody> <!-- Fin du corps du tableau -->
    </table> <!-- Fin du tableau -->
</section> <!-- Fin de la section admin utilisateurs -->

<?php include '../includes/footer.php'; ?>
