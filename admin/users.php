<?php
require_once '../includes/auth.php';
requireAdmin();

// Suppression (avec logs RGPD)
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("INSERT INTO gdpr_logs (user_id, action, details) VALUES (?, 'delete', 'Suppression par admin')");
    $stmt->execute([$_GET['delete']]);
    
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'");
    $stmt->execute([$_GET['delete']]);
    header('Location: users.php');
    exit;
}

$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
?>
<?php include '../includes/header.php'; ?>

<section class="admin-users">
    <div class="admin-header">
        <h1>Gestion des Utilisateurs</h1>
        <a href="index.php" class="btn-back">← Retour au tableau de bord</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Rôle</th>
                <th>Inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['prenom']) ?></td>
                <td><?= htmlspecialchars($user['telephone'] ?? '-') ?></td>
                <td><span style="color: <?= $user['role'] === 'admin' ? '#e74c3c' : '#27ae60' ?>"><?= ucfirst($user['role']) ?></span></td>
                <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                <td>
                    <?php if($user['role'] !== 'admin'): ?>
                        <a href="?delete=<?= $user['id'] ?>" 
                           onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    <?php else: ?>
                        <span style="color: #95a5a6;">Protégé</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php include '../includes/footer.php'; ?>
