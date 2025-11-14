<?php
require_once '../includes/auth.php';
requireLogin();

// Mise à jour profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    
    $stmt = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $telephone, $_SESSION['user_id']]);
    
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'update', 'Modification profil')");
    $stmt->execute([$_SESSION['user_id']]);
    
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $success = "Profil mis à jour avec succès";
}

// Export données RGPD
if (isset($_GET['export'])) {
    $stmt = $pdo->prepare("SELECT email, nom, prenom, telephone, created_at FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $data = $stmt->fetch();
    
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'export', 'Export données')");
    $stmt->execute([$_SESSION['user_id']]);
    
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="mes_donnees.json"');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// Suppression compte
if (isset($_POST['delete_account'])) {
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'delete', 'Auto-suppression')");
    $stmt->execute([$_SESSION['user_id']]);
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    session_destroy();
    header('Location: /techsolutions/index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
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
