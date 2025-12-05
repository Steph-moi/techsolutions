<?php // Ouverture du tag PHP
require_once '../includes/auth.php'; // Inclusion du fichier d'authentification
requireLogin(); // Vérification que l'utilisateur est connecté

// Mise à jour profil - Commentaire expliquant la mise à jour du profil utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) { // Vérifie si le formulaire de mise à jour a été soumis
    $nom = trim($_POST['nom']); // Récupère et nettoie le nom saisi
    $prenom = trim($_POST['prenom']); // Récupère et nettoie le prénom saisi
    $telephone = trim($_POST['telephone']); // Récupère et nettoie le téléphone saisi
    
    $stmt = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, telephone = ? WHERE id = ?"); // Prépare la requête de mise à jour du profil
    $stmt->execute([$nom, $prenom, $telephone, $_SESSION['user_id']]); // Exécute la mise à jour avec les nouvelles données
    
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'update', 'Modification profil')"); // Prépare l'insertion d'un log RGPD pour traçabilité
    $stmt->execute([$_SESSION['user_id']]); // Exécute l'insertion du log
    
    $_SESSION['nom'] = $nom; // Met à jour le nom en session
    $_SESSION['prenom'] = $prenom; // Met à jour le prénom en session
    $success = "Profil mis à jour avec succès"; // Définit le message de succès
}

// Export données RGPD - Commentaire expliquant l'export des données personnelles
if (isset($_GET['export'])) { // Vérifie si l'export des données est demandé
    $stmt = $pdo->prepare("SELECT email, nom, prenom, telephone, created_at FROM users WHERE id = ?"); // Prépare la requête pour récupérer les données utilisateur
    $stmt->execute([$_SESSION['user_id']]); // Exécute la requête avec l'ID utilisateur
    $data = $stmt->fetch(); // Récupère les données
    
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'export', 'Export données')"); // Prépare l'insertion d'un log RGPD pour l'export
    $stmt->execute([$_SESSION['user_id']]); // Exécute l'insertion du log
    
    header('Content-Type: application/json'); // Définit le type de contenu JSON
    header('Content-Disposition: attachment; filename="mes_donnees.json"'); // Force le téléchargement du fichier
    echo json_encode($data, JSON_PRETTY_PRINT); // Convertit et affiche les données en JSON formaté
    exit; // Arrêt de l'exécution du script
}

// Suppression compte - Commentaire expliquant la suppression du compte utilisateur
if (isset($_POST['delete_account'])) { // Vérifie si la suppression du compte est demandée
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'delete', 'Auto-suppression')"); // Prépare l'insertion d'un log RGPD pour la suppression
    $stmt->execute([$_SESSION['user_id']]); // Exécute l'insertion du log
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?"); // Prépare la requête de suppression du compte
    $stmt->execute([$_SESSION['user_id']]); // Exécute la suppression
    
    session_destroy(); // Détruit la session utilisateur
    header('Location: /techsolutions/index.php'); // Redirection vers la page d'accueil
    exit; // Arrêt de l'exécution du script
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?"); // Prépare la requête pour récupérer les infos utilisateur
$stmt->execute([$_SESSION['user_id']]); // Exécute la requête avec l'ID utilisateur
$user = $stmt->fetch(); // Récupère les données de l'utilisateur connecté
?>
<?php include '../includes/header.php'; ?>

<section class="client-profile">
    <h1>Mon Profil</h1>
    
    <?php if(isset($success)): ?>
        <div class="alert success"><?= $success ?></div>
    <?php endif; ?>
    
    <div class="profile-form">
        <h2>Mes Informations</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($user['telephone'] ?? '') ?>">
            </div>
            
            <button type="submit" name="update">Mettre à jour</button>
        </form>
    </div>
    
    <div class="gdpr-actions">
        <h2>Mes Droits RGPD</h2>
        <p>Conformément au RGPD, vous disposez des droits suivants :</p>
        
        <a href="?export=1" class="btn-export">Exporter mes données</a>
        
        <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
            <button type="submit" name="delete_account" class="btn-delete">Supprimer mon compte</button>
        </form>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
