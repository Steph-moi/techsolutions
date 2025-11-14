<?php require_once 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="contact">
    <h1>Contactez-nous</h1>
    
    <?php if(isset($_SESSION['contact_success'])): ?>
        <div class="alert success">Votre message a été envoyé avec succès !</div>
        <?php unset($_SESSION['contact_success']); ?>
    <?php endif; ?>
    
    <form id="contactForm" action="/techsolutions/api/contact.php" method="POST">
        <div class="form-group">
            <label for="nom">Nom *</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="sujet">Sujet *</label>
            <input type="text" id="sujet" name="sujet" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <div class="form-group checkbox">
            <input type="checkbox" id="consent" name="consent_rgpd" required>
            <label for="consent">
                J'accepte que mes données personnelles soient collectées et traitées conformément 
                à la <a href="/techsolutions/rgpd.php" target="_blank">politique de confidentialité</a> *
            </label>
        </div>
        
        <button type="submit">Envoyer</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
