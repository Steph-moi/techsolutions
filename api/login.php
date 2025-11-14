<?php
require_once '../config/database.php';

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /techsolutions/index.php');
    exit;
}

// Traitement connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        
        if ($user['role'] === 'admin') {
            header('Location: /techsolutions/admin/index.php');
        } else {
            header('Location: /techsolutions/client/profile.php');
        }
        exit;
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>
<?php include '../includes/header.php'; ?>

<section class="login">
    <h1>Connexion</h1>
    
    <?php if(isset($error)): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Se connecter</button>
    </form>
</section>

<?php include '../includes/footer.php'; ?>
